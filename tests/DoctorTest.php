<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Doctor.php";

    $server = 'mysql:host=localhost;dbname=doctors_office_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DoctorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Doctor::deleteAll();
            Category::deleteAll();
        }

        function test_getName()
        {
            $name = "Jeff";
            $specialty = "Dentist";
            $test_Doctor = new Doctor($name, $specialty);

            $result = $test_Doctor->getName();

            $this->assertEquals($name, $result);
        }

        function test_getSpecialty()
        {
            $name = "Jeff";
            $specialty = "Dentist";
            $test_Doctor = new Doctor($name, $specialty);

            $result = $test_Doctor->getSpecialty();

            $this->assertEquals($specialty, $result);
        }


        function test_getId()
        {
            $name = "Jeff";
            $specialty = "Dentist";
            $id = 1;
            $test_Doctor = new Doctor($name, $specialty, $id);

            $result = $test_Doctor->getId();

            $this->assertEquals(true, is_numeric($result));

        }

        function test_save()
        {
            $name = "Jeff";
            $specialty = "Dentist";
            $test_Doctor = new Doctor($name, $specialty);
            $test_Doctor->save();

            $result = Doctor::getAll();

            $this->assertEquals($test_Doctor, $result[0]);
        }

        function test_getAll()
        {
            $name = "Jeff";
            $name2 = "Ken";
            $specialty = "Dentist";
            $specialty2 = "Podiatrist";
            $test_Doctor = new Doctor($name, $specialty);
            $test_Doctor->save();
            $test_Doctor2 = new Doctor($name, $specialty);
            $test_Doctor2->save();

            $result = Doctor::getAll();

            $this->assertEquals([$test_Doctor, $test_Doctor2], $result);
        }

        function test_deleteAll()
        {
            $name = "Jeff";
            $name2 = "Ken";
            $specialty = "Dentist";
            $specialty2 = "Podiatrist";
            $test_Doctor = new Doctor($name, $specialty);
            $test_Doctor->save();
            $test_Doctor2 = new Doctor($name, $specialty);
            $test_Doctor2->save();

            Doctor::deleteAll();
            $result = Doctor::getAll();

            $this->assertEquals([], $result);
        }

        function testGetPatients()
        {
            $name = "Jeff";
            $specialty = "Dentist";
            $id = null;
            $test_Doctor = new Doctor($name, $specialty);
            $test_Doctor->save();

            $test_doctor_id = $test_doctor->getId();

            $patient_name = "Ben";
            $birthdate = "1980-01-01";
            $test_patient = new Patient ($patient_name, $patient_id, $birthdate, $test_doctor_id);

            $patient_name2 = "Gen";
            $birthdate2 = "1982-02-02";
            $test_patient2 = new Patient ($patient_name2, $patient_id, $birthdate2, $test_doctor_id);

            $result = $test_doctor->getPatients();

            $this->assertEquals([$test_patient, $test_patient2], $result);
        }
    }
?>
