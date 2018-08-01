<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 24/07/18
 * Time: 16:50
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\SubCategory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    private const CATEGORIES = [
        "Romans et Littérature" => [
            "Littérature française",
            "Littérature classique",
            "Littérature anglophone",
            "Polars, thrillers",
            "SF, Fantasy",
            "Romance",
            "Récits de voyage",
            "Romans historiques",
            "Théâtre",
            "Poésie",
            "Anthologies",
            "Humour",
            "VO",
        ],
        "BD et Comics" => [
            "BD classiques",
            "BD indépendantes",
            "BD Jeunesse",
            "Classiques littéraires en BD",
            "Humour",
            "Polar et thriller",
            "Fantastique et SF",
            "Histoire",
            "Biographies en BD",
            "Comics",
            "Mangas, Manwha, Man Hua",
            "Shonen",
            "Seinen, Josei",
        ],
        "Jeunesse" => [
            "Albums illustrés",
            "Livres à écouter",
            "Tout-petits - Moins de 3 ans",
            "De 4 à 6 ans",
            "De 7 à 12 ans",
            "Mondes imaginaires",
            "Romans historiques",
            "Adolescents et jeunes adultes",
            "Documentaires",
            "Arts",
            "Nature et animaux",
            "Histoire",
            "Mythes et légendes",
        ],
        "Loisirs et Bien-être" => [
            "Cuisine",
            "Régimes",
            "Loisirs créatifs",
            "Jardinage",
            "Sport et jeux",
            "Développement personnel",
            "Méditation",
            "Médecines douces",
            "Yoga",
            "Idées de voyages",
            "Guides France",
            "Beaux Livres Monde",
            "Récits de voyage",
            "Randonnée",
        ],
        "Art, Musique et Cinéma" => [
            "Essais sur l'art",
            "Histoire de l'art",
            "Courants artistiques",
            "Art des grandes civilisations",
            "Photographie",
            "Essais sur le cinéma",
            "Histoire du cinéma",
            "Réalisateurs",
            "Acteurs",
            "Musique",
            "Danse",
            "Mode et textiles",
            "Design",
            "Architecture",
        ],
        "Savoir et Société" => [
            "Politique",
            "Histoire",
            "Géographie",
            "Religions",
            "Ésotérisme",
            "Sociologie",
            "Questions de société",
            "Économie",
            "Droit",
            "Philosophie",
            "Psychanalyse",
            "Psychologie",
            "Sciences",
            "Médecine",
        ],
        "Scolaire et Pédagogie" => [
            "École primaire",
            "Collège",
            "Lycée",
            "Technique et professionnel",
            "Exercices et révisions",
            "Littérature scolaire",
            "Pédagogie",
            "Concours",
            "Dictionnaires de français",
            "Méthodes d'anglais",
            "Linguistique",
            "Essais littéraires",
        ]
    ];

    public function __construct() {
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ( self::CATEGORIES as $categoryName => $subCategories )
        {
            $category = new Category();

            $category->setName( $categoryName );

            $manager->persist($category);

            foreach ( $subCategories as $subCategoryName )
            {
                $subCategory = new SubCategory();

                $subCategory->setName( $subCategoryName );
                $subCategory->setCategory( $category );
//                $subCategory->setLocation( $subCategory );

                $manager->persist($subCategory);
            }
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 0;
    }
}