<?php
require __DIR__ . '/monster.php';

function getMonsters()
{
    /*return [
        [
            'name' => 'Domovoï',
            'strength' => 30,
            'life' => 300,
            'type' => 'water'
        ],
        [
            'name' => 'Wendigos',
            'strength' => 100,
            'life' => 450,
            'type' => 'earth'
        ],
        [
            'name' => 'Thunderbird',
            'strength' => 400,
            'life' => 500,
            'type' => 'air'
        ],
        [
            'name' => 'Sirrush',
            'strength' => 250,
            'life' => 1500,
            'type' => 'fire'
        ],
    ];*/
    $m1=new Monster();
    $m1->setName('Domovoi');
    $m1->setstrength(30);
    $m1->setlife(32);
    $m1->settype('Black');


    $m2=new Monster();
    $m2->setName('Wendigos');
    $m2->setstrength(60);
    $m2->setlife(36);
    $m2->settype('Pink');

    $m3=new Monster();
    $m3->setName('Thunderbird');
    $m3->setstrength(40);
    $m3->setlife(20);
    $m3->settype('Grrey');

    $m4=new Monster();
    $m4->setName('Sirrush');
    $m4->setstrength(20);
    $m4->setlife(18);
    $m4->settype('Bleu');

    $tab = [$m1,$m2,$m3,$m4];
    return $tab;
        
}
function getmonstersBDD()
{
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=monsters;charset=utf8', 'root', '123456');
    }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
    $reponse = $bdd->query('SELECT name, strength, life, type FROM monster');
    $monstersAux = array();    
    foreach ($reponse->fetchAll() as $monster) {
        $monstersAux[] = new Monster($monster['name'],$monster['strength'],$monster['life'],$monster['type']);
    }
    return $monstersAux;
}

/**
 * Our complex fighting algorithm!
 *
 * @return array With keys winning_ship, losing_ship & used_jedi_powers
 */
function fight(monster $firstMonster, monster $secondMonster)
{
    $firstMonsterLife = $firstMonster->getlife();
    $secondMonsterLife = $secondMonster->getlife();

    while ($firstMonsterLife > 0 && $secondMonsterLife > 0) {
        $firstMonsterLife = $firstMonsterLife - $secondMonster->getstrength();
        $secondMonsterLife = $secondMonsterLife - $firstMonster->getstrength();
    }

    if ($firstMonsterLife <= 0 && $secondMonsterLife <= 0) {
        $winner = null;
        $looser = null;
    } elseif ($firstMonsterLife <= 0) {
        $winner = $secondMonster;
        $looser = $firstMonster;
    } else {
        $winner = $firstMonster;
        $looser = $secondMonster;
    }

return [$winner,$looser];
  /*  return monster(
         $w= $winner,
         $l=$looser,
       // 'winner' => $winner,
       // 'looser' => $looser,
    );*/
}