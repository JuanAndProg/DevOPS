<?php 
Class Task
{   
    private int $id;
    private static int $lastId = 0;
    public string $author;
    public string $name;
    public string $description;
    public string $status;
    // TODO: chequear el tipo de dato de startDate y endDate, porque DateTime no se puede pasar a Json
    public DateTime $startDate;
    public DateTime $endDate;

    // Constructor

    // TODO: Quizá sea mejor asignarle cadena vacía a description, ver como viene de formulario

    public function __construct(string $author, string $name,?string $description = null, string $status = "Pending") {
        //Puede ser $this->(No me anduvo) o self::(que sí lleva $) 
        $this->id = ++self::$lastId;
        $this->author = $author;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
    }
    
    // Getters y Setters    
    
    //Get the value of id
    
    public function getId(): int
    {
        return $this->id;
    }
    
    // Get the value of $author

     public function getAuthor() : string
     {
        return $this->author;
     }
     
     // Set the value of $author
     
     public function setAuthor(string $author): self
     {
         $this->$author = $author;
         
         return $this;
     }

    //Get the value of name
    
    public function getName(): string
    {
        return $this->name;
    }

    //Set the value of name
     
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

     //Get the value of description
     
    public function getDescription(): string
    {
        return $this->description;
    }

    // Set the value of description
    
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    //Get the value of status

    public function getStatus(): string
    {
        return $this->status;
    }

    // Set the value of status

    // TODO: Hacer algo como un ENUM para los estados, o quizá ya puede venir directo de un select de formulario
    
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    // Get the value of startDate
    
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    // Set the value of startDate

    public function setStartDate(DateTime $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    // Get the value of endDate

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    // Set the value of endDate
    
    public function setEndDate(DateTime $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
}
?>