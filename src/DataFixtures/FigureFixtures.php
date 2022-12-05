<?php

namespace App\DataFixtures;

use App\Entity\Figure;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FigureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $author = $this->getReference(UserFixtures::ADMIN_USER_REFERENCE);

        $figure1 = new Figure();
        $figure1->setCategory($this->getReference('group4'));
        $figure1->setAuthor($author);
        $figure1->setName("La manière de rider");
        $figure1->setDescription("Tout d'abord, il faut savoir qu'il y a deux positions sur sa planche: regular ou goofy. Un rider regular aura son pied gauche devant et un rider goofy aura son pied droit devant. Après un certain moment, les planchistes sont capables de descendre dans les deux positions. Un rider regular qui descend en position goofy, dira qu'il descend « switch ». Généralement, une manœuvre sera considéré comme plus difficile quand elle est effectué « switch ».");
        $figure1->setSlug("La-maniere-de-rider");
        $figure1->setCreationDate(new DateTimeImmutable);
        $figure1->setUpdateDate(new DateTimeImmutable);
        $manager->persist($figure1);
        $manager->flush();



        $figure2 = new Figure();
        $figure2->setCategory($this->getReference('group5'));
        $figure2->setAuthor($author);
        $figure2->setName("Les grabs");
        $figure2->setDescription("Un grab consiste à attraper la planche avec la main pendant le saut. Le verbe anglais to grab signifie « attraper. »

        Il existe plusieurs types de grabs selon la position de la saisie et la main choisie pour l'effectuer, avec des difficultés variables :
        
        - mute : saisie de la carre frontside de la planche entre les deux pieds avec la main avant ;
        - sad ou melancholie ou style week : saisie de la carre backside de la planche, entre les deux pieds, avec la main avant ;
        - indy : saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière ;
        - stalefish : saisie de la carre backside de la planche entre les deux pieds avec la main arrière ;
        - tail grab : saisie de la partie arrière de la planche, avec la main arrière ;
        - nose grab : saisie de la partie avant de la planche, avec la main avant ;
        - japan ou japan air : saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside.
        - seat belt: saisie du carre frontside à l'arrière avec la main avant ;
        - truck driver: saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture)
        
        Un grab est d'autant plus réussi que la saisie est longue. De plus, le saut est d'autant plus esthétique que la saisie du snowboard est franche, ce qui permet au rideur d'accentuer la torsion de son corps grâce à la tension de sa main sur la planche. On dit alors que le grab est tweaké (le verbe anglais to tweak signifie « pincer » mais a également le sens de « peaufiner »).");
        $figure2->setSlug("Les-grabs");
        $figure2->setCreationDate(new DateTimeImmutable);
        $figure2->setUpdateDate(new DateTimeImmutable);
        $manager->persist($figure2);
        $manager->flush();



        $figure3 = new Figure();
        $figure3->setCategory($this->getReference('group1'));
        $figure3->setAuthor($author);
        $figure3->setName("Les rotations");
        $figure3->setDescription("On désigne par le mot « rotation » uniquement des rotations horizontales ; les rotations verticales sont des flips. Le principe est d'effectuer une rotation horizontale pendant le saut, puis d'attérir en position switch ou normal. La nomenclature se base sur le nombre de degrés de rotation effectués  :

            - un 180 désigne un demi-tour, soit 180 degrés d'angle ;
            - 360, trois six pour un tour complet ;
            - 540, cinq quatre pour un tour et demi ;
            - 720, sept deux pour deux tours complets ;
            - 900 pour deux tours et demi ;
            - 1080 ou big foot pour trois tours ;
            - etc.
            
            Une rotation peut être frontside ou backside : une rotation frontside correspond à une rotation orientée vers la carre backside. Cela peut paraître incohérent mais l'origine étant que dans un halfpipe ou une rampe de skateboard, une rotation frontside se déclenche naturellement depuis une position frontside (i.e. l'appui se fait sur la carre frontside), et vice-versa. Ainsi pour un rider qui a une position regular (pied gauche devant), une rotation frontside se fait dans le sens inverse des aiguilles d'une montre.
            
            Une rotation peut être agrémentée d'un grab, ce qui rend le saut plus esthétique mais aussi plus difficile car la position tweakée a tendance à déséquilibrer le rideur et désaxer la rotation. De plus, le sens de la rotation a tendance à favoriser un sens de grab plutôt qu'un autre. Les rotations de plus de trois tours existent mais sont plus rares, d'abord parce que les modules assez gros pour lancer un tel saut sont rares, et ensuite parce que la vitesse de rotation est tellement élevée qu'un grab devient difficile, ce qui rend le saut considérablement moins esthétique.
            
            Pour entrer sur une barre de slide, le rideur peut se mettre perpendiculaire à l'axe de la barre et fera donc un quart de tour en l'air, modulo 360 degrés — il est possible de faire n tours complets plus un quart de tour. On a donc la dénomination suivante pour ce type de rotations :
            
            - 90 pour un quart de tour simple ;
            - 270 pour trois quarts de tours ;
            - 450 pour un tour un quart ;
            - 630 pour un tour trois quarts ;
            - 810 pour deux tours un quart ;
            - etc.");
        $figure3->setSlug("Les-rotations");
        $figure3->setCreationDate(new DateTimeImmutable);
        $figure3->setUpdateDate(new DateTimeImmutable);
        $manager->persist($figure3);
        $manager->flush();



        $figure4 = new Figure();
        $figure4->setCategory($this->getReference('group1'));
        $figure4->setAuthor($author);
        $figure4->setName("Les flips");
        $figure4->setDescription("Un flip est une rotation verticale. On distingue les front flips, rotations en avant, et les back flips, rotations en arrière.

        Il est possible de faire plusieurs flips à la suite, et d'ajouter un grab à la rotation.
        
        Les flips agrémentés d'une vrille existent aussi (Mac Twist, Hakon Flip...), mais de manière beaucoup plus rare, et se confondent souvent avec certaines rotations horizontales désaxées.
        
        Néanmoins, en dépit de la difficulté technique relative d'une telle figure, le danger de retomber sur la tête ou la nuque est réel et conduit certaines stations de ski à interdire de telles figures dans ses snowparks.");
        $figure4->setSlug("Les-flips");
        $figure4->setCreationDate(new DateTimeImmutable);
        $figure4->setUpdateDate(new DateTimeImmutable);
        $manager->persist($figure4);
        $manager->flush();



        $figure5 = new Figure();
        $figure5->setCategory($this->getReference('group1'));
        $figure5->setAuthor($author);
        $figure5->setName("Les rotations désaxées");
        $figure5->setDescription("Une rotation désaxée est une rotation initialement horizontale mais lancée avec un mouvement des épaules particulier qui désaxe la rotation. Il existe différents types de rotations désaxées (corkscrew ou cork, rodeo, misty, etc.) en fonction de la manière dont est lancé le buste. Certaines de ces rotations, bien qu'initialement horizontales, font passer la tête en bas.

        Bien que certaines de ces rotations soient plus faciles à faire sur un certain nombre de tours (ou de demi-tours) que d'autres, il est en théorie possible de d'attérir n'importe quelle rotation désaxée avec n'importe quel nombre de tours, en jouant sur la quantité de désaxage afin de se retrouver à la position verticale au moment voulu.
        
        Il est également possible d'agrémenter une rotation désaxée par un grab.");
        $figure5->setSlug("Les-rotations-desaxees");
        $figure5->setCreationDate(new DateTimeImmutable);
        $figure5->setUpdateDate(new DateTimeImmutable);
        $manager->persist($figure5);
        $manager->flush();



        $figure6 = new Figure();
        $figure6->setCategory($this->getReference('group3'));
        $figure6->setAuthor($author);
        $figure6->setName("Les slides");
        $figure6->setDescription("Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé.

        On peut slider avec la planche centrée par rapport à la barre (celle-ci se situe approximativement au-dessous des pieds du rideur), mais aussi en nose slide, c'est-à-dire l'avant de la planche sur la barre, ou en tail slide, l'arrière de la planche sur la barre.");
        $figure6->setSlug("Les-slides");
        $figure6->setCreationDate(new DateTimeImmutable);
        $figure6->setUpdateDate(new DateTimeImmutable);
        $manager->persist($figure6);
        $manager->flush();



        $figure7 = new Figure();
        $figure7->setCategory(NULL);
        $figure7->setAuthor($author);
        $figure7->setName("Les one foot tricks");
        $figure7->setDescription("Figures réalisée avec un pied décroché de la fixation, afin de tendre la jambe correspondante pour mettre en évidence le fait que le pied n'est pas fixé. Ce type de figure est extrêmement dangereuse pour les ligaments du genou en cas de mauvaise réception.");
        $figure7->setSlug("Les-one-foot-tricks");
        $figure7->setCreationDate(new DateTimeImmutable);
        $figure7->setUpdateDate = NULL;
        $manager->persist($figure7);
        $manager->flush();



        $figure8 = new Figure();
        $figure8->setCategory(NULL);
        $figure8->setAuthor($author);
        $figure8->setName("Old school");
        $figure8->setDescription("Le terme old school désigne un style de freestyle caractérisée par en ensemble de figure et une manière de réaliser des figures passée de mode, qui fait penser au freestyle des années 1980 - début 1990 (par opposition à new school) :

        - figures désuètes : Japan air, rocket air, ...
        - rotations effectuées avec le corps tendu
        - figures saccadées, par opposition au style new school qui privilégie l'amplitude
        
        À noter que certains tricks old school restent indémodables :
        
        - Backside Air
        - Method Air");
        $figure8->setSlug("Old-school");
        $figure8->setCreationDate(new DateTimeImmutable);
        $figure8->setUpdateDate = "NULL";
        $manager->persist($figure8);
        $manager->flush();



        $figure9 = new Figure();
        $figure9->setCategory($this->getReference('group2'));
        $figure9->setAuthor($author);
        $figure9->setName("Sauts");
        $figure9->setDescription("Les tricks sont pour la plupart du temps, des rotations qui peuvent être de plusieurs types, combinées ou non avec un grab, et effectuées en position normal ou switch. La dénomination des figures ainsi créées répond à l'usage suivant  :

            - d'abord le mot « switch » si la figure est effectuée du côté non naturel
            - ensuite le nom du type de désaxage de la rotation si la figure est une rotation désaxée
            - puis le nom de la rotation elle-même, c’est-à-dire le nombre de degrés effectués
            - si la figure est grabée, le nom du grab
            
            Par exemple, un « switch rodeo cinq tail grab » est un saut dans lequel le rider part de son côté non naturel, fait une rotation horizontale d'un tour et demi avec un désaxage de type rodeo, et attrape l'arrière de sa planche pendant la rotation.
            
            La connaissance du mode de départ (normal ou switch) et du nombre de tours suffit à connaître le sens dans lequel le rideur atterrira .");
        $figure9->setSlug("Sauts");
        $figure9->setCreationDate(new DateTimeImmutable);
        $figure9->setUpdateDate(new DateTimeImmutable);
        $manager->persist($figure9);
        $manager->flush();



        $figure10 = new Figure();
        $figure10->setCategory($this->getReference('group3'));
        $figure10->setAuthor($author);
        $figure10->setName("Barre de slide");
        $figure10->setDescription("Pour les barres de slide, la dénomination se fait de la manière suivante :

        - d'abord le nom de la figure d'entrée si elle est autre qu'un 90, suivi du mot anglais to
        - le nom du slide (nose slide ou tail slide) ou le mot anglais rail si le slide est classique
        - enfin le nom de la figure de sortie si elle est autre qu'un 90, précédée du mot anglais to
        
        Par exemple, un switch 270 to rail signifie que le rideur part du côté non naturel, qu'il effectue trois quarts de tour avant de slider normalement sur la barre, puis qu'il sort avec un quart de tour.
        
        Un « rail to switch » signifie que le rider est sorti de la barre avec un quart de tour qui l'a amené de son côté non naturel. De même, le « switch to rail » consiste à entrer sur la barre en partant en arrière et en effectuant un quart de tour.
        
        Lorsque le rideur effectue une rotation au milieu de la barre, on rajoute au nom de la figure un « to figure to rail ». Par exemple, un 270 to rail to 180 to rail to switch signifie que le rideur rentre sur la barre avec 3 quarts de tours, puis effectue un demi-tour en milieu de barre (que les riders appellent aussi « sexchange »), et sort enfin avec un quart de tour qui le fait atterrir en arrière.
        
        Parfois, quand seule la figure d'entrée ou de sortie est notable, par exemple un 630, on parle d'un « 630 in » ou « 630 out ».");
        $figure10->setSlug("Barre-de-slide");
        $figure10->setCreationDate(new DateTimeImmutable);
        $figure10->setUpdateDate(new DateTimeImmutable);
        $manager->persist($figure10);
        $manager->flush();

        // references
        $this->addReference('figure1', $figure1);
        $this->addReference('figure2', $figure2);
        $this->addReference('figure3', $figure3);
        $this->addReference('figure4', $figure4);
        $this->addReference('figure5', $figure5);
        $this->addReference('figure6', $figure6);
        $this->addReference('figure7', $figure7);
        $this->addReference('figure8', $figure8);
        $this->addReference('figure9', $figure9);
        $this->addReference('figure10', $figure10);
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}