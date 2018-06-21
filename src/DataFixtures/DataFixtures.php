<?php
/**
 * Created by PhpStorm.
 * User: willkoua
 * Date: 18-05-28
 * Time: 22:45
 */

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Show;
use App\Entity\Theater;
use App\Entity\Ticket;

class DataFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $theater = new Theater();
            $theater->setAddress($i . " rue " . $i . " Montreal, Quebec");
            $theater->setCapacity($i * 100);
            $theater->setAdministrator($i);
            $manager->persist($theater);

            // create 10 Shows!
            for ($j = 0; $j < 10; $j++){
                $show = $this->getShow($j, $theater);

                for ($k = 0; $k < 100; $k++){
                    $manager->persist($this->getTicket($show));
                }
                $manager->persist($show);
            }
                
        }

        $manager->flush();
    }

    private function getShow(int $i, Theater $theater):Show
    {
        $date = new \DateTime(date('Y-m-d H:i:s'), new \DateTimeZone( 'America/New_York'));
        $show = new Show();

        $show->setTitle('Spectacle_'. $i);
        $show->setArtist('Personna non grata '. $i);
        $show->setDate($date);
        $show->setDescription('Equitis Romani autem esse filium criminis loco poni 
            ab accusatoribus neque his iudicantibus oportuit neque defendentibus nobis. Nam quod 
            de pietate dixistis, est quidem ista nostra existimatio, sed iudicium certe parentis; 
            quid nos opinemur, audietis ex iuratis; quid parentes sentiant, lacrimae matris incredibilisque 
            maeror, squalor patris et haec praesens maestitia, quam cernitis, luctusque declarat.');
        $show->setTheater($theater);

        return $show;
    }
    
    private function getTicket(Show $show):Ticket
    {
        $ticket = new Ticket();
        $ticket->setPrice(20.00);
        $ticket->setShow($show);
        return $ticket;
    }
    
}