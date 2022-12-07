<?php
 
class cal
{
     
    Public $result;
    public $x;
    public $y;
 
 
    function __construct($first,$second,$oprator)
    {
        $this->x = $first;
        $this->y = $second;
        
        if ($this->y==0){
            echo -1;
        }

        else{

            switch($oprator)
        {
            case '+':
            $this->result = $this->x + $this->y;
            break;

            case '-':
            $this->result = $this->x - $this->y;
            break;

            case '*':
            $this->result = $this->x * $this->y;
            break;

            case '/':
            $this->result = $this->x / $this->y;
            break;

            default:
            echo 0;
        }   
        }
 
 
    }    

    function show_result()
    {
        if($this->result==0){
            return 0;
        }
        else{
            echo "Your calculation is ".$this->result."\n";
        }
       
    } 
}
     
$cal_obj= new cal(10,5,'+');
$cal_obj->show_result();
     
 
?>



