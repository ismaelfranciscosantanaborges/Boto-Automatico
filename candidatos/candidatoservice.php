<?php

class candidatoservice implements Iserviciobase{
 
    private $servicio;
    private $context;

    public function __construct($directory){
        
        $this->servicio = new Servicio();
        $this->context = new Context($directory);
    }
    public function GetlistaP(){

        $listarcandidato = array();
    
        $stmt = $this->context->db->prepare("select * from candidatos where Puesto = 1");
        $stmt->execute();
        $result= $stmt->get_result();
    
        if($result->num_rows === 0){
            
            return $listarcandidato;
        }else{
            
            while($row = $result->fetch_object()){
                
              $candidato = new candidato();

                $candidato->ID= $row->ID;
                $candidato->Nombre= $row->Nombre;
                $candidato->Apellido= $row->Apellido;
                $candidato->Partido= $row->Partido;
                $candidato->Puesto= $row->Puesto;
                $candidato->Foto= $row->Foto;
                $candidato->Estado= $row->Estado;

                array_push($listarcandidato,$candidato); 
            }
        }
        
    return $listarcandidato;
    $stmt->close();
    
    }
    public function Getlista(){

        $listarcandidato = array();
    
        $stmt = $this->context->db->prepare("select * from candidatos");
        $stmt->execute();
        $result= $stmt->get_result();
    
        if($result->num_rows === 0){
            
            return $listarcandidato;
        }else{
            
            while($row = $result->fetch_object()){
                
              $candidato = new candidato();

                $candidato->ID= $row->Id;
                $candidato->Nombre= $row->Nombre;
                $candidato->Apellido= $row->Apellido;
                $candidato->Partido= $row->Partido;
                $candidato->Puesto= $row->Puesto;
                $candidato->Foto= $row->Foto;
                $candidato->Estado= $row->Estado;

                array_push($listarcandidato,$candidato); 
            }
        }
        
    return $listarcandidato;
    $stmt->close();
    
    }
    public function GetlistaD(){

        $listarcandidato = array();
    
        $stmt = $this->context->db->prepare("select * from candidatos where Puesto = 2");
        $stmt->execute();
        $result= $stmt->get_result();
    
        if($result->num_rows === 0){
            
            return $listarcandidato;
        }else{
            
            while($row = $result->fetch_object()){
                
              $candidato = new candidato();

                $candidato->ID= $row->Id;
                $candidato->Nombre= $row->Nombre;
                $candidato->Apellido= $row->Apellido;
                $candidato->Partido= $row->Partido;
                $candidato->Puesto= $row->Puesto;
                $candidato->Foto= $row->Foto;
                $candidato->Estado= $row->Estado;

                array_push($listarcandidato,$candidato); 
            }
        }
        
    return $listarcandidato;
    $stmt->close();
    
    }

    public function GetlistaS(){

        $listarcandidato = array();
    
        $stmt = $this->context->db->prepare("select * from candidatos where Puesto = 3");
        $stmt->execute();
        $result= $stmt->get_result();
    
        if($result->num_rows === 0){
            
            return $listarcandidato;
        }else{
            
            while($row = $result->fetch_object()){
                
              $candidato = new candidato();

                $candidato->ID= $row->Id;
                $candidato->Nombre= $row->Nombre;
                $candidato->Apellido= $row->Apellido;
                $candidato->Partido= $row->Partido;
                $candidato->Puesto= $row->Puesto;
                $candidato->Foto= $row->Foto;
                $candidato->Estado= $row->Estado;

                array_push($listarcandidato,$candidato); 
            }
        }
        
    return $listarcandidato;
    $stmt->close();
    
    }
    public function GetlistaA(){

        $listarcandidato = array();
    
        $stmt = $this->context->db->prepare("select * from candidatos where Puesto = 4");
        $stmt->execute();
        $result= $stmt->get_result();
    
        if($result->num_rows === 0){
            
            return $listarcandidato;
        }else{
            
            while($row = $result->fetch_object()){
                
              $candidato = new candidato();

                $candidato->ID= $row->Id;
                $candidato->Nombre= $row->Nombre;
                $candidato->Apellido= $row->Apellido;
                $candidato->Partido= $row->Partido;
                $candidato->Puesto= $row->Puesto;
                $candidato->Foto= $row->Foto;
                $candidato->Estado= $row->Estado;

                array_push($listarcandidato,$candidato); 
            }
        }
        
    return $listarcandidato;
    $stmt->close();
    
    }
    public function GetByid($id){

        $candidato = new candidato();
    
     $stmt = $this->context->db->prepare("select * from candidatos where Id = ?");
     $stmt->bind_param("i",$id);
        
        $stmt->execute();
    
        $result= $stmt->get_result();
    
        if($result->num_rows === 0){
            
            return null;
        }else{
            
            while($row = $result->fetch_object()){
    
                $candidato->ID= $row->Id;
                $candidato->Nombre= $row->Nombre;
                $candidato->Apellido= $row->Apellido;
                $candidato->Partido= $row->Partido;
                $candidato->Puesto= $row->Puesto;
                $candidato->Foto= $row->Foto;
                $candidato->Estado= $row->Estado;
            }
        }
    return $candidato; 
    $stmt->close();
    
    }
    
    public function añadir($entidad)
{

     $stmt = $this->context->db->prepare("insert into candidatos (Nombre,Apellido,Partido,Foto,Puesto,Estado,voto) Values(?,?,?,?,?,?,?)");
     $stmt->bind_param("ssiisi",$entidad->Nombre,$entidad->Apellido,$entidad->Partido, $entidad->Foto,$entidad->Puesto,$entidad->Estado,$entidad->voto);
     $stmt->execute();
     $stmt->close();

     $candidatoid = $this->context->db->insert_id;

     if(isset($_FILES['foto'])){
     
        $photofile=$_FILES['foto'];
    
        if($photofile['error']==4){
        
        $entidad->foto = "";
        
       }else{
           
    
    $typeReplace = str_replace("image/", "", $_FILES['foto']['type']);
     $type= $photofile['type'];
     $size= $photofile['size'];
     $name= $candidatoid . '.' . $typeReplace;
     $tmpname= $photofile['tmp_name'];
     
     $success=$this->servicio->uploadImage('imagenes/candidato/',$name,$tmpname,$type,$size);
     
     if($success){
         
      $stmt = $this->context->db->prepare("update candidatos set Foto = ? where Id = ? ");
    
         $stmt->bind_param("si",$name,$candidatoid);
         $stmt->execute();
         $stmt->close();
     }
    }
    }
}

public function eliminar($id){
    $stmt = $this->context->db->prepare("delete from candidatos where Id = ? ");
       $stmt->bind_param("i",$id);
       $stmt->execute();
       $stmt->close();
  
  }
  public function editar($id,$entidad){
    
    $elemento= $this->GetByid($id);
        
         $stmt = $this->context->db->prepare("update candidatos set Nombre = ?,Apellido = ?,Partido= ?,
         Puesto= ?,Estado= ? where Id = ?");
         $stmt->bind_param("ssiisi",$entidad->Nombre,$entidad->Apellido,$entidad->Partido,$entidad->Puesto
         ,$entidad->Estado,$id);
         $stmt->execute();
         $stmt->close();
    
         if(isset($_FILES['foto'])){
    
            $photofile=$_FILES['foto'];
            
        if($photofile['error']==4){
            
            $entidad->profilePhoto = $elemento->profilePhoto;
            
        }else{
            
        $typeReplace = str_replace("image/", "", $_FILES['foto']['type']);
         $type= $photofile['type'];
         $size=$photofile['size'];
         $name=$id . '.' . $typeReplace;
         $tmpname=$photofile['tmp_name'];
         
         $success=$this->servicio->uploadImage('imagenes/candidato/',$name,$tmpname,$type,$size);
         
         if($success){
              $stmt = $this->context->db->prepare("update candidatos set Foto= ? where Id =? ");
        
             $stmt->bind_param("si",$name,$id);
             $stmt->execute();
             $stmt->close();
         }
            
        }
        }
         
        
    }
    public function votar($id,$entidad){
    
        $elemento= $this->GetByid($id);
            
        
        $stmt = $this->context->db->prepare("insert into votos (voto) values(?) where Id = ?");
        $stmt->bind_param("ii",$entidad->voto,$id);
        $stmt->execute();
        $stmt->close();
            
             
            
        }
    
}