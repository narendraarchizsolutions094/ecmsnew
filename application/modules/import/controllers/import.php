<?php

class Import extends MX_Controller {

public function __construct() {
        parent::__construct();

        
      $this->load->model('modules/imports/models/import_model','import_model');
      $this->load->helper('file');
         
    }

    function index() {
     
            $this->load->view('home/dashboard');
            $this->load->view('imports/import');
            $this->load->view('home/footer');
        
    }

    function indexDynamic() {
         $count=0;
        $fp = fopen($_FILES['filename']['tmp_name'],'r') or die("can't open file");
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $insert_csv = array();
                $insert_csv['phone'] = $csv_line[0];//remove if you want to have primary key,
                $insert_csv['name'] = $csv_line[1];
                $insert_csv['email'] = $csv_line[2];
                $insert_csv['dob'] = $csv_line[3];
                $insert_csv['ward_no'] = $csv_line[4];
                $insert_csv['voter_id'] = $csv_line[5];
                $insert_csv['age'] = $csv_line[6];
                $insert_csv['address'] = $csv_line[7];
                $insert_csv['sex'] = $csv_line[8];

            }
            $i++;
            $data = array(
                'phone' => $insert_csv['phone'] ,
                'name' => $insert_csv['name'],
                'email' => $insert_csv['email'],
                'dob' => $insert_csv['dob'],
                'ward_no' => $insert_csv['ward_no'],
                'voter_id' => $insert_csv['voter_id'],
                'age' => $insert_csv['age'],
                'address' => $insert_csv['address'],
                'sex' => $insert_csv['sex'],

            $data['crane_features']=$this->db->insert('volunteer', $data);
        }
        fclose($fp) or die("can't close file");
        $data['success']="success";
        return $data;

    }

    }

    // function importfile() {
    //     if (isset($_FILES["filename"]["name"])) {
    //         $path = $_FILES["filename"]["tmp_name"];
    //         $object = PHPExcel_IOFactory::load($path);

    //         foreach ($object->getWorksheetIterator() as $worksheet) {
    //             $highestRow = $worksheet->getHighestRow();

    //             $highestColumn = $worksheet->getHighestColumn();
    //             for ($row = 2; $row <= $highestRow; $row++) {
    //                 $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
    //                 $stdid = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
    //                 $add = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
    //                 $fnam = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
    //                 $mnam = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
    //                 $edu = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
    //                 $email = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
    //                 $password = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
    //                 $phone = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

    //                 $name1 = array();
    //                 $name1 = explode(" ", $name);
    //                 if (empty($name1[1])) {
    //                     $name1[1] = '';
    //                 }
    //                 $additional_data = [
    //                     'first_name' => $name1[0],
    //                     'last_name' => $name1[1],
    //                     'phone' => $phone,
    //                 ];
    //                 $grp[] = 2;
    //                 $identity = $email;
    //                 $this->ion_auth->register($identity, $password, $email, $additional_data, $grp);
    //                 $ionid = $this->ion_auth->get_user_id_from_identity($email);
    //                 $data[] = array(
    //                     'Name' => $name,
    //                     'studentID' => $stdid,
    //                     'Address' => $add,
    //                     'FatherName' => $fnam,
    //                     'MotherName' => $mnam,
    //                     'ionid' => $ionid,
    //                     'Eduation' => $edu
    //                 );
    //             }

    //             $this->import_model->insertData($data);
    //         }
    //     }
    // }

  





    // function importfiledynamic() {
    //     if (isset($_FILES["filename"]["name"])) {
    //         $path = $_FILES["filename"]["tmp_name"];
    //         $tablename = $this->input->post('tablename');
    //         $this->importDynamicclient($path, $tablename);
    //     }
    // }

    // function importDynamic($file, $tablename) {
    //     $object = PHPExcel_IOFactory::load($file);

    //     foreach ($object->getWorksheetIterator() as $worksheet) {
    //         $highestRow = $worksheet->getHighestRow();    //get Highest Row
    //         $highestColumnLetter = $worksheet->getHighestColumn(); //get column highest as  letter
    //         $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter); // convert letter to column index in number
    //         for ($column1 = 0; $column1 < $highestColumn; $column1++) {
    //             $rowData1[] = $worksheet->getCellByColumnAndRow($column1, 1)->getValue();
    //         }
    //         $headerexist = $this->import_model->headerExist($rowData1, $tablename); // get boolean header exist or not
    //         if ($headerexist) {
    //             $headerName = $this->import_model->getTable($tablename);  // table header name
    //             for ($row = 2; $row <= $highestRow; $row++) {
    //                 $rowData = [];
    //                 for ($column = 0; $column < $highestColumn; $column++) {
    //                     $rowData[] = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
    //                 }
    //                 $data = array_combine($rowData1, $rowData);

    //                 $this->import_model->dataEntry($data, $tablename);
    //             }
    //         }
    //     }
    // }

    // function importDynamicclient($file, $tablename) {
    //     $object = PHPExcel_IOFactory::load($file);
    //     foreach ($object->getWorksheetIterator() as $worksheet) {
    //         $highestRow = $worksheet->getHighestRow();    //get Highest Row
    //         $highestColumnLetter = $worksheet->getHighestColumn(); //get column highest as  letter
    //         $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter); // convert letter to column index in number
    //         for ($column1 = 0; $column1 < $highestColumn; $column1++) {
    //             $rowData1[] = $worksheet->getCellByColumnAndRow($column1, 1)->getValue();
    //         }

    //         //  print_r($rowData1);
    //         //   die(); 

    //         $headerexist = $this->import_model->headerExistclient($rowData1, $tablename); // get boolean header exist or not
    //         //   echo $headerexist;




    //         if ($headerexist) {
    //             for ($row = 2; $row <= $highestRow; $row++) {
    //                 $rowData = [];
    //                 $rowData2 = [];

    //                 for ($column = 0; $column < $highestColumn; $column++) {
    //                     if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'password') {
    //                         $rowData3[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
    //                     } else {
    //                         $rowData2[] = $worksheet->getCellByColumnAndRow($column, 1)->getValue();
    //                         //echo $worksheet->getCellByColumnAndRow($column2, 1)->getValue();
    //                     }

    //                     if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) != 'password') {
    //                                 $rowData[] = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
    //                     }
    //                     if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'name') {
    //                         $name = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
    //                     }
    //                     if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'phone') {
    //                         $phone = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
    //                     }
    //                     if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'password') {

    //                         $password = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
    //                     }
    //                     if (strtolower($worksheet->getCellByColumnAndRow($column, 1)->getValue()) === 'email') {

    //                         $email = $worksheet->getCellByColumnAndRow($column, $row)->getValue();
    //                     }
    //                 }



    //                 if ($this->ion_auth->email_check($email)) {
    //                     $exist_email[] = $row;
    //                     $exist_rows = implode(',', $exist_email);
    //                     $message = 'Rows number ' . $exist_rows . ' contain the emails which already exist!';
    //                 } else {
    //                     $grp = 5;
    //                     $user_name = $name;
    //                     $this->ion_auth->register($user_name, $password, $email, $grp);
    //                     $ionid = $this->db->get_where('users', array('email' => $email))->row()->id;
    //                     array_push($rowData, $ionid);
    //                     array_push($rowData2, 'ion_user_id');
    //                     $data = array_combine($rowData2, $rowData);
    //                     $this->import_model->dataEntry($data, $tablename);
    //                 }
    //             }
    //             $this->session->set_flashdata('feedback', lang('successful_data_import'));
    //             $this->session->set_flashdata('message', $message);
    //         } else {
    //             $this->session->set_flashdata('feedback', lang('wrong_file_format'));
    //         }
    //     }


    //     redirect('import');
    // }

}
?>

