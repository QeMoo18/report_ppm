<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Server_generator extends CI_Controller {

    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Server_generator_model'); 



        // $base_img = 'https://scanner.gadingtech.com/qr_code/nav/details_item/';

    }


	function index()
	{

	}

    function server()
    {
        // https://arjunphp.com/generate-excel-phpspreadsheet-codeigniter-php/

        //STYLINGS
        $style = [
            'font' => [
                'color' => array('rgb' => '000000')
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'B6D7A8',
                ],
            ],
        ];

        $style2 = [
            'font' => [
                'color' => array('rgb' => 'FFFFFF'),
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'ED7D31',
                ],
            ],
        ];

        $style3 = [
            'font' => [
                'color' => array('rgb' => 'FFFFFF'),
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '990000',
                ],
            ],
        ];
        //

        //INIT SPREADSHEET - one sheet document
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getDefaultStyle()->getFont()->setSize(9);
        $sheet = $spreadsheet->getActiveSheet();
        //

        //CREATE CUSTOM HEADERS
        //Row 1
        $sheet->setCellValue('A1', 'Hostname');
        $sheet->setCellValue('B1', 'Description');
        $sheet->setCellValue('C1', 'Prod IP Address');
        $sheet->setCellValue('D1', 'OS Version');
        $sheet->setCellValue('E1', "CPU (Core)");
        $sheet->setCellValue('F1', "Memory (GB)");
        $sheet->setCellValue('G1', 'Remarks');

        //Styling
        $sheet->getStyle('A1')->applyFromArray($style);
        $sheet->getStyle('B1')->applyFromArray($style);
        $sheet->getStyle('C1')->applyFromArray($style);
        $sheet->getStyle('D1')->applyFromArray($style);
        $sheet->getStyle('E1')->applyFromArray($style);
        $sheet->getStyle('F1')->applyFromArray($style);
        $sheet->getStyle('G1')->applyFromArray($style);

        //QUERY DATA
        $query = $this->Server_generator_model->server_data()->result();
        //

        //DATA MASSAGE AND FILL
        $highestColumn = $sheet->getHighestColumn();
        $dt_init_row = 2;
        $dt_curr_row = $dt_init_row;

        foreach ($query as $row) {
            $data = array();
            array_push($data, 
                [
                    $row->name,
                    $row->description,
                    $row->ip,
                    $row->operating_system,
                    $row->cpu_core,
                    $row->Ram,
                    $row->comment 
                ]
            );
            $sheet->fromArray($data,NULL,'A'.$dt_curr_row);
            $dt_curr_row++;
        }
      
      
        //SAVE-DOWNLOAD DOCUMENT
        $writer = new Xlsx($spreadsheet);

        $filename = 'server';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer->save('php://output'); // download file 
        //

    }

    function network()
    {
      // https://arjunphp.com/generate-excel-phpspreadsheet-codeigniter-php/
      
      //STYLINGS
      $style = [
        'font' => [
            'size' => 9,
            'color' => array('rgb' => '000000'),222
        ],
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'bottom' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'right' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'left' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => 'B6D7A8',
            ],
        ],
      ];

      $style2 = [
        'font' => [
            'size' => 9,
            'color' => array('rgb' => 'FFFFFF'),
        ],
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'bottom' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'right' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'left' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => 'ED7D31',
            ],
        ],
      ];

      $style3 = [
        'font' => [
            'size' => 9,
            'color' => array('rgb' => 'FFFFFF'),
        ],
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'bottom' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'right' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'left' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => '990000',
            ],
        ],
      ];
      //

      //INIT SPREADSHEET - one sheet document
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      //

      //CREATE CUSTOM HEADERS
      //Row 1
      $sheet->setCellValue('A1', 'Hostname');
      $sheet->setCellValue('B1', 'Description');
      $sheet->setCellValue('C1', 'Prod IP Address');
      $sheet->setCellValue('D1', 'OS Version');
      $sheet->setCellValue('E1', 'CPU (Core)');
      $sheet->setCellValue('F1', 'Memory (GB)');
      $sheet->setCellValue('G1', 'Remarks');

      //Styling
      $sheet->getStyle('A1')->applyFromArray($style);
      $sheet->getStyle('B1')->applyFromArray($style);
      $sheet->getStyle('C1')->applyFromArray($style);
      $sheet->getStyle('D1')->applyFromArray($style);
      $sheet->getStyle('E1')->applyFromArray($style);
      $sheet->getStyle('F1')->applyFromArray($style);
      $sheet->getStyle('G1')->applyFromArray($style);

      //DATA FILL
      //
      
      //SAVE-DOWNLOAD DOCUMENT
      $writer = new Xlsx($spreadsheet);
     
      $filename = 'network';
     
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
      header('Cache-Control: max-age=0');
     
      $writer->save('php://output'); // download file 
      //

    }
}