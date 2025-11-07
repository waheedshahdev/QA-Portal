<?php





/**

 *

 */

class Common
{
    private $CI;

    private $data;

    public function __construct()
    {
        $this->CI = & get_instance();

        $this->CI->load->helper('cruds_helper');
    }




  //// QA Evaluate Leads Code ////
    // public function evaluate_leads_lib($lead_id)
    // {
    //     $decode_lead_id = trim(decode_id($lead_id));
    //     $l_id = 'tbl_mortgage.mort_lead_id = "'.$decode_lead_id.'"';

    //     $array_1 = array(
    //               'lead_data' => get_query_data('SELECT *
    //                                 FROM `tbl_mortgage` 
    //                                 JOIN tbl_mortgage_disposition as D on D.lead_id = tbl_mortgage.mort_lead_id 
    //                                 JOIN tbl_employee_data as E on E.ein = D.creation_person 
    //                                 JOIN tbl_clients as C on C.id = tbl_mortgage.Client_Transfer_To 
    //                                 JOIN tbl_clients_lo_list as L on C.id = L.client_id
    //                                 where '.$l_id.''),

    //               'questions'    => get_query_data('SELECT * FROM qa_questions where status = 1'),
    //                   );
              

    //     ;

    //     return $array_1 ;
    // }


   public function generate_qa_report($retrive_data = '') {

            $phpExcel = new PHPExcel();      
            $foo = $phpExcel->getActiveSheet();
            $phpExcel->getActiveSheet()->getStyle('A1:U1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $phpExcel->getActiveSheet()->getStyle('A1:U1000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            // Header styling
            $phpExcel->getActiveSheet()->getStyle('A1:U1')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '1F497D')
                    ),

                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('rgb' => '000000'),        
                        )
                    ),

                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => 'FFFFFF'),
                    )
                )
            );

            // Set header titles
            $foo->setCellValue('A1','No');  
            $foo->setCellValue('B1','DS');  
            $foo->setCellValue('C1','Grade');
            $foo->setCellValue('D1','Percentage');
            $foo->setCellValue('E1','Question 1');  
            $foo->setCellValue('F1','Question 2');  
            $foo->setCellValue('G1','Question 3');  
            $foo->setCellValue('H1','Question 4');  
            $foo->setCellValue('I1','Question 5');  
            $foo->setCellValue('J1','Question 6');  
            $foo->setCellValue('K1','Question 7');  
            $foo->setCellValue('L1','Question 8');  
            $foo->setCellValue('M1','Question 9');  
            $foo->setCellValue('N1','Question 10');  
            $foo->setCellValue('O1','Question 11');  
            $foo->setCellValue('P1','Question 12');  
            $foo->setCellValue('Q1','Question 13');  
            $foo->setCellValue('R1','Question 14');  
            $foo->setCellValue('S1','Question 15');  
            $foo->setCellValue('T1','Question 16');  
            $foo->setCellValue('U1','Question 17');  

            // Align header text center both horizontal & vertical
            $phpExcel->getActiveSheet()->getStyle('A1:U1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $phpExcel->getActiveSheet()->getStyle('A1:U1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            // Set column widths
            foreach (range('A','U') as $col) {
                $foo->getColumnDimension($col)->setWidth(18);
            }

            $cellIndex = 2;
            $count = 1;

            foreach ($retrive_data as $key => $value) {
             $avg_percentage =    $value->avg_percentage;
                if ($avg_percentage >= 97) {
                $avg_grade = 'A+';
                $avg_color = '4CAF50';
                } elseif ($avg_percentage >= 93) {
                    $avg_grade = 'A';
                    $avg_color = '66BB6A';
                } elseif ($avg_percentage >= 87) {
                    $avg_grade = 'B+';
                    $avg_color = '9CCC65';
                } elseif ($avg_percentage >= 83) {
                    $avg_grade = 'B';
                    $avg_color = 'FFEB3B';
                } elseif ($avg_percentage >= 77) {
                    $avg_grade = 'C+';
                    $avg_color = 'FFC107';
                } elseif ($avg_percentage >= 73) {
                    $avg_grade = 'C';
                    $avg_color = 'FF9800';
                } elseif ($avg_percentage >= 67) {
                    $avg_grade = 'D+';
                    $avg_color = 'FF7043';
                } elseif ($avg_percentage >= 60) {
                    $avg_grade = 'D';
                    $avg_color = 'F44336';
                } else {
                    $avg_grade = 'F';
                    $avg_color = 'B71C1C';
                }

                $count1               = $count++;    
                $lo                   = $value->lo;
                $grade                 = $avg_grade;
                $Average              = $value->avg_percentage;
                $q1_avg              = $value->q1_avg;
                $q2_avg              = $value->q2_avg;
                $q3_avg              = $value->q3_avg;
                $q4_avg              = $value->q4_avg;
                $q5_avg              = $value->q5_avg;
                $q6_avg              = $value->q6_avg;
                $q7_avg              = $value->q7_avg;
                $q8_avg              = $value->q8_avg;
                $q9_avg              = $value->q9_avg;
                $q10_avg              = $value->q10_avg;
                $q11_avg              = $value->q11_avg;
                $q12_avg              = $value->q12_avg;
                $q13_avg              = $value->q13_avg;
                $q14_avg              = $value->q14_avg;
                $q15_avg              = $value->q15_avg;
                $q16_avg              = $value->q16_avg;
                $q17_avg              = $value->q17_avg;

                $foo->setCellValue('A'.$cellIndex , $count1)
                    ->setCellValue('B'.$cellIndex , $lo)
                    ->setCellValue('C'.$cellIndex , $grade)
                    ->setCellValue('D'.$cellIndex , $Average)
                    ->setCellValue('E'.$cellIndex , $q1_avg)
                    ->setCellValue('F'.$cellIndex , $q2_avg)
                    ->setCellValue('G'.$cellIndex , $q3_avg)
                    ->setCellValue('H'.$cellIndex , $q4_avg)
                    ->setCellValue('I'.$cellIndex , $q5_avg)
                    ->setCellValue('J'.$cellIndex , $q6_avg)
                    ->setCellValue('K'.$cellIndex , $q7_avg)
                    ->setCellValue('L'.$cellIndex , $q8_avg)
                    ->setCellValue('M'.$cellIndex , $q9_avg)
                    ->setCellValue('N'.$cellIndex , $q10_avg)
                    ->setCellValue('O'.$cellIndex , $q11_avg)
                    ->setCellValue('P'.$cellIndex , $q12_avg)
                    ->setCellValue('Q'.$cellIndex , $q13_avg)
                    ->setCellValue('R'.$cellIndex , $q14_avg)
                    ->setCellValue('S'.$cellIndex , $q15_avg)
                    ->setCellValue('T'.$cellIndex , $q16_avg)
                    ->setCellValue('U'.$cellIndex , $q17_avg);

                // Apply border for the entire row
                $phpExcel->getActiveSheet()->getStyle("A{$cellIndex}:U{$cellIndex}")->applyFromArray(
                    [
                        'borders' => [
                            'allborders' => [
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ],
                    ]
                );

                // Conditional styling for Percentage (Column J)
                $Average = $value->avg_percentage;

                if ($Average >= 97) {
                    $percent_color = '4CAF50';
                } elseif ($Average >= 93) {
                    $percent_color = '66BB6A';
                } elseif ($Average >= 87) {
                    $percent_color = '9CCC65';
                } elseif ($Average >= 83) {
                    $percent_color = 'FFEB3B';
                } elseif ($Average >= 77) {
                    $percent_color = 'FFC107';
                } elseif ($Average >= 73) {
                    $percent_color = 'FF9800';
                } elseif ($Average >= 67) {
                    $percent_color = 'FF7043';
                } elseif ($Average >= 60) {
                    $percent_color = 'F44336';
                } else {
                    $percent_color = 'B71C1C';
                }

                $phpExcel->getActiveSheet()->getStyle("D{$cellIndex}")->applyFromArray([
                    'fill' => [
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => ['rgb' => $percent_color],
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'],
                        'bold' => true,
                    ],
                ]);

                $cellIndex++;
            }

            $phpExcel->setActiveSheetIndex(0);
            $file_name = 'QA_Summary_'.date('Ymd').'.xls';

            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$file_name."");
            header("Cache-Control: max-age=0");

            $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
            $objWriter->save("php://output");
            exit;

            return $file_name;
        }

           public function generate_qa_sheet($retrive_data = '', $retrive_avg_data='') {
            $phpExcel = new PHPExcel();      
            $foo = $phpExcel->getActiveSheet();
            // Center-align all cells
            $phpExcel->getActiveSheet()->getStyle('A1:U1000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $phpExcel->getActiveSheet()->getStyle('A1:U1000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $phpExcel->getActiveSheet()->getStyle('A3:U3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $phpExcel->getActiveSheet()->getStyle('A3:U3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            // Header styling
            $headerStyle = [
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['rgb' => '1F497D']
                ],
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],        
                    ]
                ],
                'font'  => [
                    'bold'  => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ]
            ];

            $phpExcel->getActiveSheet()->getStyle('A1:U1')->applyFromArray($headerStyle);

            // Set header titles
            $foo->setCellValue('A1','No');  
            $foo->setCellValue('B1','DS');  
            $foo->setCellValue('C1','Grade');
            $foo->setCellValue('D1','Percentage');
            $foo->setCellValue('E1','Question 1');  
            $foo->setCellValue('F1','Question 2');  
            $foo->setCellValue('G1','Question 3');  
            $foo->setCellValue('H1','Question 4');  
            $foo->setCellValue('I1','Question 5');  
            $foo->setCellValue('J1','Question 6');  
            $foo->setCellValue('K1','Question 7');  
            $foo->setCellValue('L1','Question 8');  
            $foo->setCellValue('M1','Question 9');  
            $foo->setCellValue('N1','Question 10');  
            $foo->setCellValue('O1','Question 11');  
            $foo->setCellValue('P1','Question 12');  
            $foo->setCellValue('Q1','Question 13');  
            $foo->setCellValue('R1','Question 14');  
            $foo->setCellValue('S1','Question 15');  
            $foo->setCellValue('T1','Question 16');  
            $foo->setCellValue('U1','Question 17');  

            // Align header row center
            $phpExcel->getActiveSheet()->getStyle('A1:U1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $phpExcel->getActiveSheet()->getStyle('A1:U1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            // Merge and label Weight row
            $foo->mergeCells('A2:D2');
            $foo->setCellValue('A2', 'Weight');
            $phpExcel->getActiveSheet()->getStyle('A2:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $foo->setCellValue('E2','3');  
            $foo->setCellValue('F2','3');  
            $foo->setCellValue('G2','3');  
            $foo->setCellValue('H2','3');  
            $foo->setCellValue('I2','5');  
            $foo->setCellValue('J2','5');  
            $foo->setCellValue('K2','10');  
            $foo->setCellValue('L2','3');  
            $foo->setCellValue('M2','3');  
            $foo->setCellValue('N2','15');  
            $foo->setCellValue('O2','15');  
            $foo->setCellValue('P2','3');  
            $foo->setCellValue('Q2','15');  
            $foo->setCellValue('R2','2');  
            $foo->setCellValue('S2','2');  
            $foo->setCellValue('T2','5');  
            $foo->setCellValue('U2','5'); 

            // Merge and label Total Cumulative
            $foo->mergeCells('A3:U3');
            $foo->setCellValue('A3','Total (Cumulative): 100');

            // Avg Data
            $q_avgs = (array) $retrive_avg_data[0];
            $avg_percentage = $q_avgs['avg_percentage'];

            if ($avg_percentage >= 97) {
                $avg_grade = 'A+';
                $avg_color = '4CAF50';
            } elseif ($avg_percentage >= 93) {
                $avg_grade = 'A';
                $avg_color = '66BB6A';
            } elseif ($avg_percentage >= 87) {
                $avg_grade = 'B+';
                $avg_color = '9CCC65';
            } elseif ($avg_percentage >= 83) {
                $avg_grade = 'B';
                $avg_color = 'FFEB3B';
            } elseif ($avg_percentage >= 77) {
                $avg_grade = 'C+';
                $avg_color = 'FFC107';
            } elseif ($avg_percentage >= 73) {
                $avg_grade = 'C';
                $avg_color = 'FF9800';
            } elseif ($avg_percentage >= 67) {
                $avg_grade = 'D+';
                $avg_color = 'FF7043';
            } elseif ($avg_percentage >= 60) {
                $avg_grade = 'D';
                $avg_color = 'F44336';
            } else {
                $avg_grade = 'F';
                $avg_color = 'B71C1C';
            }

            $foo->setCellValue('A4','Agents Average');  
            $foo->setCellValue('C4',$avg_grade);  
            $foo->setCellValue('D4',$avg_percentage);  

            for ($i = 1; $i <= 17; $i++) {
                $column = chr(68 + $i); // E-U
                $foo->setCellValue($column . '4', $q_avgs['q' . $i . '_avg']);
            }

            // Apply styling (row 4 same as header)
            $phpExcel->getActiveSheet()->getStyle('A4:U4')->applyFromArray($headerStyle);
            $phpExcel->getActiveSheet()->getStyle('A4:U4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $phpExcel->getActiveSheet()->getStyle('A4:U4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            // Apply borders to rows 2-4
            foreach (range(2, 4) as $row) {
                $phpExcel->getActiveSheet()->getStyle("A{$row}:U{$row}")->applyFromArray([
                    'borders' => [
                        'allborders' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            }

            // Set column widths
            foreach (range('A','U') as $col) {
                $foo->getColumnDimension($col)->setWidth(17);
            }

            // Populate agent data
            $cellIndex = 5;
            $count = 1;

            foreach ($retrive_data as $value) {
                $foo->setCellValue('A'.$cellIndex , $count++)
                    ->setCellValue('B'.$cellIndex , $value->lo)
                    ->setCellValue('C'.$cellIndex , $value->grade)
                    ->setCellValue('D'.$cellIndex , $value->percentage)
                    ->setCellValue('E'.$cellIndex , $value->q1_score)
                    ->setCellValue('F'.$cellIndex , $value->q2_score)
                    ->setCellValue('G'.$cellIndex , $value->q3_score)
                    ->setCellValue('H'.$cellIndex , $value->q4_score)
                    ->setCellValue('I'.$cellIndex , $value->q5_score)
                    ->setCellValue('J'.$cellIndex , $value->q6_score)
                    ->setCellValue('K'.$cellIndex , $value->q7_score)
                    ->setCellValue('L'.$cellIndex , $value->q8_score)
                    ->setCellValue('M'.$cellIndex , $value->q9_score)
                    ->setCellValue('N'.$cellIndex , $value->q10_score)
                    ->setCellValue('O'.$cellIndex , $value->q11_score)
                    ->setCellValue('P'.$cellIndex , $value->q12_score)
                    ->setCellValue('Q'.$cellIndex , $value->q13_score)
                    ->setCellValue('R'.$cellIndex , $value->q14_score)
                    ->setCellValue('S'.$cellIndex , $value->q15_score)
                    ->setCellValue('T'.$cellIndex , $value->q16_score)
                    ->setCellValue('U'.$cellIndex , $value->q17_score);

                // Borders for row
                $phpExcel->getActiveSheet()->getStyle("A{$cellIndex}:U{$cellIndex}")->applyFromArray([
                    'borders' => [
                        'allborders' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Percentage coloring based on same logic as avg
                $Average = $value->percentage;

                if ($Average >= 97) {
                    $percent_color = '4CAF50';
                } elseif ($Average >= 93) {
                    $percent_color = '66BB6A';
                } elseif ($Average >= 87) {
                    $percent_color = '9CCC65';
                } elseif ($Average >= 83) {
                    $percent_color = 'FFEB3B';
                } elseif ($Average >= 77) {
                    $percent_color = 'FFC107';
                } elseif ($Average >= 73) {
                    $percent_color = 'FF9800';
                } elseif ($Average >= 67) {
                    $percent_color = 'FF7043';
                } elseif ($Average >= 60) {
                    $percent_color = 'F44336';
                } else {
                    $percent_color = 'B71C1C';
                }

                $phpExcel->getActiveSheet()->getStyle("D{$cellIndex}")->applyFromArray([
                    'fill' => [
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => ['rgb' => $percent_color],
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'],
                        'bold' => true,
                    ],
                ]);

                $cellIndex++;
            }

            $phpExcel->setActiveSheetIndex(0);
            $file_name = 'QA_Evaluation_'.date('Ymd').'.xls';

            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$file_name."");
            header("Cache-Control: max-age=0");

            $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
            $objWriter->save("php://output");
            exit;

            return $file_name;
        }

// public function generate_qa_sheet($retrive_data = '') {

   //          $phpExcel = new PHPExcel();      
   //          $foo = $phpExcel->getActiveSheet();

   //          // Header styling
   //          $phpExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray(
   //              array(
   //                  'fill' => array(
   //                      'type' => PHPExcel_Style_Fill::FILL_SOLID,
   //                      'color' => array('rgb' => '1F497D')
   //                  ),

   //                  'borders' => array(
   //                      'allborders' => array(
   //                          'style' => PHPExcel_Style_Border::BORDER_THIN,
   //                          'color' => array('rgb' => '000000'),        
   //                      )
   //                  ),

   //                  'font'  => array(
   //                      'bold'  => true,
   //                      'color' => array('rgb' => 'FFFFFF'),
   //                  )
   //              )
   //          );

   //          // Set header titles
   //          $foo->setCellValue('A1','No');  
   //          $foo->setCellValue('B1','LO');  
   //          $foo->setCellValue('C1','Call Opening');  
   //          $foo->setCellValue('D1','Need Identification');  
   //          $foo->setCellValue('E1','Product Service');  
   //          $foo->setCellValue('F1','Compliance Process'); 
   //          $foo->setCellValue('G1','Customer Call');  
   //          $foo->setCellValue('H1','Call Close');  
   //          $foo->setCellValue('I1','Total Score');
   //          $foo->setCellValue('J1','Percentage');

   //          // Align header text center both horizontal & vertical
   //          $phpExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   //          $phpExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

   //          // Set column widths
   //          foreach (range('A','J') as $col) {
   //              $foo->getColumnDimension($col)->setWidth(15);
   //          }

   //          $cellIndex = 2;
   //          $count = 1;

   //          foreach ($retrive_data as $key => $value) {

   //              $count1               = $count++;    
   //              $lo                   = $value->lo;
   //              $call_opening         = $value->call_open_avg;
   //              $need_identification  = $value->need_iden_avg;
   //              $product_service      = $value->prod_serv_avg;
   //              $compliance_process   = $value->comp_proc_avg;
   //              $customer_call        = $value->customer_call_avg;
   //              $call_close           = $value->call_clo_avg;
   //              $total_score          = $value->total_sum;
   //              $Average              = $value->percent_score;

   //              $foo->setCellValue('A'.$cellIndex , $count1)
   //                  ->setCellValue('B'.$cellIndex , $lo)
   //                  ->setCellValue('C'.$cellIndex , $call_opening)
   //                  ->setCellValue('D'.$cellIndex , $need_identification)
   //                  ->setCellValue('E'.$cellIndex , $product_service)
   //                  ->setCellValue('F'.$cellIndex , $compliance_process)
   //                  ->setCellValue('G'.$cellIndex , $customer_call)
   //                  ->setCellValue('H'.$cellIndex , $call_close)
   //                  ->setCellValue('I'.$cellIndex , $total_score)
   //                  ->setCellValue('J'.$cellIndex , $Average);

   //              // Apply border for the entire row
   //              $phpExcel->getActiveSheet()->getStyle("A{$cellIndex}:J{$cellIndex}")->applyFromArray(
   //                  [
   //                      'borders' => [
   //                          'allborders' => [
   //                              'style' => PHPExcel_Style_Border::BORDER_THIN,
   //                              'color' => ['rgb' => '000000'],
   //                          ],
   //                      ],
   //                  ]
   //              );

   //              // Conditional styling for Percentage (Column J)
   //              if ($Average < 50) {
   //                  // Red background, white font
   //                  $phpExcel->getActiveSheet()->getStyle("J{$cellIndex}")->applyFromArray([
   //                      'fill' => [
   //                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
   //                          'color' => ['rgb' => 'FF0000'], // Red
   //                      ],
   //                      'font' => [
   //                          'color' => ['rgb' => 'FFFFFF'], // White text
   //                          'bold' => true,
   //                      ],
   //                  ]);
   //              } elseif ($Average >= 50 && $Average < 85) {
   //                  // Yellow background, black font
   //                  $phpExcel->getActiveSheet()->getStyle("J{$cellIndex}")->applyFromArray([
   //                      'fill' => [
   //                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
   //                          'color' => ['rgb' => 'FFFF00'], // Yellow
   //                      ],
   //                      'font' => [
   //                          'color' => ['rgb' => '000000'], // Black text
   //                          'bold' => true,
   //                      ],
   //                  ]);
   //              } else {
   //                  // Green background, white font
   //                  $phpExcel->getActiveSheet()->getStyle("J{$cellIndex}")->applyFromArray([
   //                      'fill' => [
   //                          'type' => PHPExcel_Style_Fill::FILL_SOLID,
   //                          'color' => ['rgb' => '00B050'], // Green
   //                      ],
   //                      'font' => [
   //                          'color' => ['rgb' => 'FFFFFF'], // White text
   //                          'bold' => true,
   //                      ],
   //                  ]);
   //              }

   //              $cellIndex++;
   //          }

   //          $phpExcel->setActiveSheetIndex(0);
   //          $file_name = 'QA_Report_'.date('Ymd').'.xls';

   //          header("Content-Type: application/vnd.ms-excel");
   //          header("Content-Disposition: attachment; filename=".$file_name."");
   //          header("Cache-Control: max-age=0");

   //          $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
   //          $objWriter->save("php://output");
   //          exit;

   //          return $file_name;
   //      }



     public function edit_evaluate_leads_lib($lead_id)
    {
        $decode_lead_id = trim(decode_id($lead_id));
        $l_id = 'S.lead_id = "'.$decode_lead_id.'"';

        $array_1 = array(
                  'lead_data' => get_query_data('SELECT *,S.email as customer_email FROM tbl_solar_lead_data as S JOIN tbl_disposition as D on D.id = S.disposition_id JOIN employee_data as U on U.ein = D.employee_id WHERE (D.disposition = "Live Transfer" or D.disposition = "Posted") AND '.$l_id.' AND D.status = 1'),
                  'evaluation_ans' => get_query_data('SELECT * FROM `tbl_qa_evaluation` JOIN qa_questions on qa_questions.qa_question_id = tbl_qa_evaluation.question_id where qa_questions.status = 1 and tbl_qa_evaluation.lead_id = "'.$decode_lead_id.'"'),
                  'qa_result'     => get_query_data('SELECT * FROM tbl_qa_result where lead_id = "'.$decode_lead_id.'"')
                      );
              

        ;

        return $array_1 ;
    }

    //// END QA Evaluate Leads Code ////
    //// Evaluated Leads ////
    // public function evaluated_leads_lib($from_date='', $to_date='')
    // {
    //     if ($from_date != '' && $to_date != '') {
    //         $date_filter = 'date(R.created_at) between "'.$from_date.'" and "'.$to_date.'"';
    //     // echo $date_filter;
    //     // exit();
    //     } elseif ($from_date != '' && $to_date == '') {
    //         $today_date = date('Y-m-d');
    //         $date_filter = 'date(R.created_at) between "'.$from_date.'" and "'.$today_date.'"';
    //     } else {
    //         $date_filter = 'date(R.created_at) = CURDATE()';
    //     }

    //     $array_1 = array(
    //               'evaluated_leads' => get_query_data('SELECT mort_lead_id,CONCAT(E.first_name," ",E.last_name) as agent_name, CONCAT(c_first_name, c_last_name) as customer_name, M.c_phone,Evaluation_Score,Evaluated_Result,M.created_at as lead_date, R.created_at,R.evaluator_id, D.creation_person
    //                                 FROM `tbl_qa_result` as R
    //                                 JOIN tbl_mortgage as M on M.mort_lead_id = R.lead_id
    //                                 JOIN tbl_mortgage_disposition as D on D.lead_id = M.mort_lead_id
    //                                 JOIN tbl_employee_data as E on E.ein = D.creation_person
    //                                 where '.$date_filter.' ORDER BY R.created_at DESC'),

    //                   );
              

    //     ;

    //     return $array_1 ;
    // }
    //// END Evaluated Leads ////
   public function recording_api($phone)
    {

     $url = 'https://dms9.ringtrust.net/vicidial/recording_api.php';
    $payload = array(
                'key'    => 'q4lkCzCLYJFP0DFzVTaikWamD8daK7bRk',
                'phone'    => $phone

    );


    $opts=array(
'http'=>array(
    'method'  => "POST",
    'header'  => 'Content-type: application/x-www-form-urlencoded',
    'content' => http_build_query($payload),
   'timeout' => 360
));



$context  = stream_context_create($opts);
$response = file_get_contents($url, false, $context);

// print_r($response);
 // exit();

   
        $get_data =json_decode($response, true);
        $found = $get_data['data_found'];

        // $data['recording'] = $found;
        // $array_1 = array('recording' => $found);


        return $found ;
    }





   


   



    




    
}