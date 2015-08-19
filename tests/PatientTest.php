<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Patient.php";
    require_once "src/Doctor.php";

    $server = 'mysql:host=localhost;dbname=doctors_office_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PatientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Doctor::deleteAll();
            Patient::deleteAll();
        }

        function test_getPatientId()
        {
            //doctor
            $name = "Jeff";
            $specialty = "podiatrist";
            $id = null;
            $test_doctor = new Doctor($name, $specialty, $id);
            $test_doctor->save();

            //patient
            $patient_name = "Ray";
            $birthdate = "1980-01-01";
            $patient_id = null;
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
            $test_patient->save();

            $result = $test_patient->getPatientId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getDoctorId()
        {
            //doctor
            $name = "Jeff";
            $specialty = "podiatrist";
            $id = null;
            $test_doctor = new Doctor($name, $specialty, $id);
            $test_doctor->save();

            //patient
            $patient_name = "Ray";
            $birthdate = "1980-01-01";
            $patient_id = null;
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
            $test_patient->save();

            $result = $test_patient->getDoctorId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            $name = "Jeff";
            $specialty = "podiatrist";
            $id = null;
            $test_doctor = new Doctor($name, $specialty, $id);
            $test_doctor->save();

            $patient_name = "Ray";
            $birthdate = "1980-01-01";
            $patient_id = null;
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
            $test_patient->save();

            $result = Patient::getAll();
            $this->assertEquals($test_patient, $result[0]);
        }

        function test_getAll()
        {
            $name = "Jeff";
            $specialty = "podiatrist";
            $id = null;
            $test_doctor = new Doctor($name, $specialty, $id);
            $test_doctor->save();

            $patient_name = "Ray";
            $birthdate = "1980-01-01";
            $patient_id = null;
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
            $test_patient->save();

            $patient_name2 = "Steve";
            $birthdate = "1978-01-01";
            $doctor_id = $test_doctor->getId();
            $test_patient2 = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
            $test_patient2->save();

            $result = Patient::getAll();

            $this->assertEquals([$test_patient, $test_patient2], $result);
        }

        function deleteAll()
        {
            $name = "Jeff";
            $specialty = "podiatrist";
            $id = null;
            $test_doctor = new Doctor($name, $specialty, $id);
            $test_doctor->save();

            $patient_name = "Ray";
            $birthdate = "1980-01-01";
            $patient_id = null;
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
            $test_patient->save();

            $patient_name2 = "Steve";
            $birthdate = "1978-01-01";
            $doctor_id = $test_doctor->getId();
            $test_patient2 = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
            $test_patient2->save();

            $result = Doctor::deleteAll();

            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $name = "Jeff";
            $specialty = "podiatrist";
            $id = null;
            $test_doctor = new Doctor($name, $specialty, $id);
            $test_doctor->save();

            $patient_name = "Ray";
            $birthdate = "1980-01-01";
            $patient_id = null;
            $doctor_id = $test_doctor->getId();
            $test_patient = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
            $test_patient->save();

            $patient_name2 = "Steve";
            $birthdate = "1978-01-01";
            $doctor_id = $test_doctor->getId();
            $test_patient2 = new Patient($patient_name, $patient_id, $birthdate, $doctor_id);
            $test_patient2->save();

            $id = $test_patient->getPatientId();
            $result = Patient::find($id);

            $this->assertEquals($test_patient, $result);
        }
    }

?>
