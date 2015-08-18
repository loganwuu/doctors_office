<?php
    class Doctor {
        private $name;
        private $specialty;
        private $id;

        function __construct($name, $specialty, $id=null)
        {
            $this->name = $name;
            $this->specialty = $specialty;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getSpecialty()
        {
            return $this->specialty;
        }

        function setSpecialty($new_specialty)
        {
            $this->specialty = (string) $new_specialty;
        }

        function getPatients()
        {
            $patients = array();
            $returned_patients = $GLOBALS['DB']->query("SELECT * FROM patients WHERE doctor_id={$this->getId()};");
            foreach($returned_patients as $patient){
                $patient_name = $patient['patient_name'];
                $patient_id = $patient['patient_id'];
                $birthdate = $patient['birthdate'];
                $doctor_id = $patient['doctor_id'];
                $new_patient = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
                array_push($patients, $new_patient);
            }
            return $patients;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO doctors (name, specialty) VALUES ('{$this->getName()}', '{$this->getSpecialty()}');");
            $result_id = $GLOBALS['DB']->lastInsertId();
            $this->setId($result_id);
        }

        static function getAll()
        {
            $returned_doctors = $GLOBALS['DB']->query("SELECT * FROM doctors;");
            $doctors = array();
            foreach($returned_doctors as $doctor) {
                $name = $doctor['name'];
                $id = $doctor['id'];
                $specialty = $doctor['specialty'];
                $new_doctor = new Doctor($name, $specialty, $id);
                array_push($doctors, $new_doctor);
            }
            return $doctors;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM doctors;");
        }

        static function find($search_id)
        {
            $found_doctor = NULL;
            $doctors = Doctor::getAll();
            foreach($doctors as $doctor) {
                $doctor_id = $doctor->getId();
                if ($doctor_id == $search_id) {
                    $found_doctor = $doctor;
                }
            }
            return $found_doctor;
        }
    }
?>
