<?php

    class Monster{
        //eric sera la valeur par défaut
        private $name;
      /*  private $lastName;
        private $age;
        private $color;*/
        private $strength;
        private $life;
        private $type;

        function __construct($n, $s, $l, $t)
        {
            $this->name=$n;
            $this->strength=$s;
            $this->life=$l;
            $this->type=$t;
        }

        function setName($n)
        {
            $this->name=$n;
        }
        function getName()
        {
            return $this->name;
        }


        function setstrength($s)
        {
            $this->strength=$s;
        }
        function getstrength()
        {
            return $this->strength;
        }


        function setlife($l)
        {
            $this->life=$l;
        }
        function getlife()
        {
            return $this->life;
        }


        function settype($t)
        {
            $this->type=$t;
        }
        function gettype()
        {
            return $this->type;
        }

        
    }


  /*  $monster1=new Monster();
    $monster1->setName('Mariam');

    var_dump($monster1);*/
?>