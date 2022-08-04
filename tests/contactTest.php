<?php
use PHPUnit\Framework\TestCase;
require_once dirname(__FILE__) .'/../model/connect.php';
require_once dirname(__FILE__) .'/../model/contact.php';

final class contactTest extends TestCase
{
	private $contact;

    //test de la fonction de validité pour des champs valides
    public function testValidityOK(): void
    {
		$this->contact = new Contact(null, "Antoine", "Mauboussin", "a@b.c", "1214121412");
        $this->assertTrue($this->contact->verifValidity());
    }
    
    //test de la fonction de validité pour un numero non valide
    public function testValidityKO(): void
    {
        $this->contact = new Contact(null, "Antoine", "Mauboussin", "a@b.c", "12a");
        $this->assertFalse($this->contact->verifValidity());
    }

    //test de la fonction de validité pour des champs valides sans numero
    public function testValidityOK2(): void
    {
		$this->contact = new Contact(null, "Antoine", "Mauboussin", "a@b.c");
        $this->assertTrue($this->contact->verifValidity());
    }

    //test de la fonction de validité pour des champs valides sans numero avec un champ vide
    public function testValidityKO2(): void
    {
        $this->contact = new Contact(null, "Antoine", "", "a@b.c");
        $this->assertFalse($this->contact->verifValidity());
    }

    //test de la fonction d'insertion
    public function testInsert(): void
    {
		$this->contact = new Contact(null, "Antoine", "Mauboussin", "a@b.c", "1214121412");
        $this->contact->insert();
        
        $compare = Contact::getFromId($GLOBALS['connect']->insert_id);

        $this->assertEquals($this->contact, $compare);
    }

    //test de la fonction de modification
    public function testModify(): void
    {
		$this->contact = new Contact(null, "Antoine", "Mauboussin", "a@b.c", "1214121412");
        $this->contact->insert();
        
        $compare = clone $this->contact;
        $compare->firstname = "Ratatoskr";
        $compare->modify();
        $compare = Contact::getFromId($this->contact->id);

        $this->assertNotEquals($this->contact, $compare);
    }

    //test de la fonction de suppression
    public function testDelete(): void
    {
		$this->contact = new Contact(null, "Antoine", "Mauboussin", "a@b.c", "1214121412");
        $this->contact->insert();
        $this->contact->delete();
        
        $this->contact = Contact::getFromId($this->contact->id);

        $this->assertNull($this->contact);
    }

    //suppression du contact de test et nettoyage de la base de donnée
	public function tearDown() : void {
        if($this->contact != null){
            $this->contact->delete();
        }
        $this->contact = null;
	}
}
