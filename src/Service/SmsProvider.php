<?php
namespace App\Service;

use Ovh\Exceptions\InvalidParameterException;
use Psr\Log\LoggerInterface;
use Ovh\Api;


class SmsProvider
{



//    /** @var array */
//    private $config;
    /** @var LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {

//        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param $phoneNumber
     * @param string $message
     * @return array|bool|mixed
     * @throws InvalidParameterException
     */
    public function sendMessage($phoneNumber, $message)
    {

        $applicationKey = getenv('APP_KEY');
        $applicationSecret = getenv('APPSMS_SECRET');
        $consumer_key = getenv('CONSUMER_KEY');
        $endpoint = getenv('END_POINT');


        $phoneNumbers = (array)$phoneNumber;

        try {

            $ovh = new Api( $applicationKey,
                $applicationSecret,
                $endpoint,
                $consumer_key);


            $smsServices = $ovh->get('/sms/');
            foreach ($smsServices as $smsService) {
                print_r($smsService); }

            $content = (object) array(
                "charset"=> "UTF-8",
                "class"=> "phoneDisplay",
                "coding"=> "7bit",
                'message' => $message,
                "noStopClause"=> false,
                "priority"=> "high",
                'receivers' => $phoneNumbers,
                "senderForResponse"=> true,
                "validityPeriod"=> 2880
            );


            //Ca fait le boulot
            $resultPostJob = $ovh->post('/sms/'. $smsServices[0] . '/jobs/', $content); //appel sur le 1er compte SMS
            dd($resultPostJob);
            print_r($resultPostJob);
            $smsJobs = $ovh->get('/sms/'. $smsServices[0] . '/jobs/'); print_r($smsJobs);


        } catch (\Exception $e) {
            echo "erreur";
            if (null !== $this->logger) {
                $this->logger->critical(
                    sprintf("Erreur lors de l'envoi SMS : %s . Trace : %s", $e->getMessage(), $e->getTraceAsString()), [
                        'paramsOvh' => $content
                    ]
                );
            }

            $result = false;
        }

        return $result;
    }

    /**
     * @param $phoneNumber
     * @return array|bool
     * @throws InvalidParameterException
     * @throws \Exception
     */
    public function removeFromBlacklist($phoneNumber)
    {
        $conn = $this->connectToApi();

        try {
            $smsServices = $conn->get('/sms/');
            $result = $conn->delete(sprintf('/sms/%s/blacklists/%s', $smsServices[0], $phoneNumber));

        } catch (\Exception $e) {
            if (null !== $this->logger) {
                $this->logger->critical(
                    sprintf('Erreur lors de la suppression du numéro de la blacklist : %s . Trace : %s', $e->getMessage(), $e->getTraceAsString())
                );
            }

            $result = false;
        }

        return $result;
    }

    /**
     * @return array|bool
     * @throws InvalidParameterException
     * @throws \Exception
     */
    public function getBlacklist()
    {
        $conn = $this->connectToApi();

        try {
            $smsServices = $conn->get('/sms/');
            $result = $conn->get(sprintf('/sms/%s/blacklists', $smsServices[0]));

        } catch (\Exception $e) {
            if (null !== $this->logger) {
                $this->logger->critical(
                    sprintf('Erreur lors de la requête GET blacklist : %s . Trace : %s', $e->getMessage(), $e->getTraceAsString())
                );
            }

            $result = false;
        }

        return $result;
    }

    /**
     * @return Api
     * @throws InvalidParameterException
     * @throws \Exception
     */
    private function connectToApi()
    {

        $config['application_key'] = getenv('APP_KEY');
        $config['application_secret'] = getenv('APPSMS_SECRET');
        $config['consumer_key'] = getenv('CONSUMER_KEY');
        $config['end_point'] = getenv('END_POINT');

//        dd($config);

        if (!isset($config['application_key'],
            $config['application_secret'],
            $config['consumer_key'],
            $config['end_point'])
        ) {
            $this->logger->error('OVH config parameters are missing');
            throw new \Exception('OVH config parameters are missing');
        }

        $applicationKey = $config['application_key'];
        $applicationSecret = $config['application_secret'];
        $consumerKey = $config['consumer_key'];
        $endPoint = $config['end_point'];

        try {

            $conn = new Api(
                $applicationKey,
                $applicationSecret,
                $endPoint,
                $consumerKey
            );

        } catch (InvalidParameterException $e) {
            $this->logger->critical(
                sprintf("Erreur lors de la connexion à l'API OVH : %s . Trace : %s", $e->getMessage(), $e->getTraceAsString())
            );

            throw $e;
        }

        return $conn;
    }



    public function getHappyMessage()
    {
        $this->logger->info('About to find a happy message!');

        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}