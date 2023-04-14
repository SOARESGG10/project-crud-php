<?php

interface iDaoModeCrud 
{
    
    public function create ($entitie);
    public function read ();
    public function update ($entitie);
    public function delete ($id);

}