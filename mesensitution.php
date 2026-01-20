<?php 

class person{
    private string $name;
    private int $age;
}


class student extends person{
   
}


interface payable{
   public function pay();
}

class Order implements payable{

     public function pay(){
        echo"vous payer avec succer";
     }
}