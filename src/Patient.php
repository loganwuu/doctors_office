<?php
    class Patient
    {
        private $patient_name;
        private $patient_id;
        private $birthdate;
        private $doctor_id;

        function __construct($patient_name, $patient_id=null, $birthdate, $doctor_id)
        {
            $this->patient_name = $patient_name;
            $this->patient_id = $patient_id;
            $this->birthdate = $birthdate;
            $this->doctor_id = $doctor_id;
        }

        function getPatientName()
        {
            return $this->patient_name;
        }

        function setPatientName($new_name)
        {
            $this->patient_name = $new_name;
        }

        function getPatientId()
        {
            return $this->patient_id;
        }

        function getDoctorId()
        {
            return $this->doctor_id;
        }

        function setBirthDate($new_birthdate)
        {
            $this->birthdate = $new_birthdate;
        }

        function getBirthDate()
        {
            return $this->birthdate;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO patients (name, birthdate, doctor_id) VALUES ('{$this->getPatientName()}', '{$this->getBirthDate()}', {$this->getDoctorId()});");
            $this->patient_id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_patients = $GLOBALS['DB']->query("SELECT * FROM patients ORDER BY name;");
            $patients = array();
            foreach($returned_patients as $patient){
                $patient_name = $patient['name'];
                $patient_id = $patient['id'];
                $birthdate = $patient['birthdate'];
                $doctor_id = $patient['doctor_id'];
                $new_patient = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
                //var_dump($new_patient);
                array_push($patients, $new_patient);
            }
            return $patients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patients;");
        }

        static function find($search_id)
        {
            $found_patient = NULL;
            $patients = Patient::getAll();
            foreach($patients as $patient){
                $patient_id = $patient->getPatientId();
                if($patient_id == $search_id){
                    $found_patient = $patient;
                }
            }
            return $found_patient;
        }

    }
?>
