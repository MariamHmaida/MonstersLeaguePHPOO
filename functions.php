<?php
require __DIR__ . '/monster.php';
//récupérer les monstres sans base données sous formes des objets
function getMonsters()
{
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
//récupérer les monstres à partir de la base des données
function getmonstersBDD()
{
    try{
        $connexion = new PDO('mysql:host=localhost;dbname=monsters;charset=utf8', 'root', '123456');
    }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
    $reponse = $connexion->query('SELECT name, strength, life, type FROM monster');
    $monstersAux = array();    
    foreach ($reponse->fetchAll() as $monster) {
        $monstersAux[] = new Monster($monster['name'],$monster['strength'],$monster['life'],$monster['type']);
    }
    return $monstersAux;
}

//boutton Add a new monster
if (isset($_POST['btn_Add_Monster']))
{
    //appeler la méthode ci dessous pour ajouter le monster entré
    Add_Monster($_POST['txtName'],$_POST['txtStrength'],$_POST['txtLife'],$_POST['txtType']);
}

/**
 * Add a new monster
 * @param $name the name of the monster to add 
 * @param $strength how strong is the monster too add 
 * @param $type tthe typeof the monster to add 
 * @param $life lives of the monster to add 
 */
function Add_Monster($name,$strength,$life,$type)
{
    try {
        //établir la connexion avec la base de données
        $connexion = new PDO('mysql:host=localhost;dbname=monsters;charset=utf8', 'root', '123456');
        //préparer la requête
        $query=$connexion->prepare("insert into monster (name,strength,life,type) values(:name,:strength,:life,:type);");
        //affecter les parametres à la requete
        $query->bindParam(':name', $name);
        $query->bindParam(':strength', $strength);
        $query->bindParam(':life', $life);
        $query->bindParam(':type', $type);
        //exécuter la requête préparée
        $query->execute(); 
    }
    catch(Exception $e ) {
        die('Erreur : ' . $e->getMessage());
    }        
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