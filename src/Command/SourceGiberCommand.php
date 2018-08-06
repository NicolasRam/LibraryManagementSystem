<?php

namespace App\Command;

use App\Service\Maker\View\DoctrineHelper;
use App\Service\Maker\View\Generator;
use App\Service\Maker\View\Str;
use App\Service\Maker\View\Validator;
use App\Service\Source\BookGiberSource;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Console\Style\SymfonyStyle;


class SourceGiberCommand extends Command
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var BookGiberSource
     */
    private $bookGiberSource;

    /**
     * @var SymfonyStyle
     */
    private $io;

    public function __construct(
        EntityManagerInterface $entityManager
        , BookGiberSource $bookGiberSource
        , $name = null
    )
    {
        parent::__construct($name);
        $this->bookGiberSource = $bookGiberSource;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName('app:source-giber')
            ->setDescription('Create books from giber website')
            ->setHelp('Create books from giber website')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);

        $this->io->title('Bienvenu dans le livres en provenance de Giber.com');

        $this->bookGiberSource->getMenu();
    }
}
