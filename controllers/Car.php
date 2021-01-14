<?php
namespace App\Controllers;

require MODELS.DIRECTORY_SEPARATOR.'car.php';

class Car
{
    private $model;
    public function __construct()
    {
        $this->model = new  \App\Model\CarModel;
    }

    public function getResults(int $offset = 0, $limit = 4)
    {
        $page_current = filter_var(($offset), FILTER_SANITIZE_NUMBER_INT);
        $offset = (max($page_current - 1, 0)) * $limit;

        $cars_arr = $this->model ->getCars($offset , $limit);

        $result_count = $this->model->getCarsCount()->count;

        $html_result = ' <span class="results_count">
                Showing  '.$result_count.' results
                </span>
                        <div class="controls">
            <button class="background-green" id="create">+ Create</button>
            <button class="background-red hidden" id="delete_multiple">- Delete all selected</button>
        </div>';

        if(!empty($cars_arr))
        {
            $html_result .='<table><thead>
                <tr>
                <th><input id="select_all" type="checkbox" ></th>
                <th>Manufacturer</th>
                <th>Model</th>
                <th>Year</th>
                <th>Hybrid</th>
                <th>4x4</th>
                <th>Automatic Gearbox</th>
                <th>Engine</th>
                <th>Fuel</th>
                <th>Login Email</th>
                <th></th>
                <th></th>
                </tr>
                </thead><tbody>';

        //Build emloyee result list

            foreach ($cars_arr as $car) {

                $id = $car->id;
                $is_hybrid = ($car->is_hybrid == 'true' )? 'Yes' : 'No';
                $is_4x4 = ( $car->is_4x4  == 'true')? 'Yes' : 'No';
                $is_automatic = ( $car->is_automatic == 'true'  )? 'Yes' : 'No';
                $manufacturer = $car->manufacturer;
                $model = $car->model;
                $year = $car->year;
                $engine = $car->engine;
                $fuel = $car->fuel;
                $email = $car->email;


                $html_result .= ' <tr data-id="'.$id.'">
 <td><input type="checkbox" value="'.$id.'"></td>
  <td>'.$manufacturer.'</td>
 <td>'.$model.'</td>
 <td>'.$year.'</td>
 <td>'.$is_hybrid.'</td>
 <td>'.$is_4x4.'</td>
 <td>'.$is_automatic.'</td>
 <td>'.$engine.'</td>
 <td>'.$fuel.'</td>
 <td>'.$email.'</td>
 <td><button class="background-blue" onclick="getSingle(\''.$id.'\')">Edit</button></td>
  <td><button class="background-red" onclick="deleteSingle(\''.$id.'\', this)">Delete</button></td>
</tr>';
            } //end foreach @employee_arr_sliced

            $html_result .='</tbody></table>';
        }else{
            $html_result .='<br><span class="alert">There are no records to show!</span> ';
        }
            // Build pagination
            $total_pages = intval(ceil($result_count / $limit));
            $page_current = intval(($page_current == 0) ? 1 : $page_current);
            $page_next = intval((($page_current * $limit) > $result_count) ? $total_pages : $page_current + 1);
            $page_prev = intval(($page_current <= 0) ? 1 : $page_current - 1);
            $bef_prev = intval($page_prev - 1);
            $aft_next = intval($page_next + 1);

            if ($total_pages > 1) {
                $pagination = '<section class="pagination">';

                $pagination .= '<div class="btn_back ';
                if ($page_current != '1') {
                    $pagination .= ' "><li><a href="?offset=' . $page_prev . '">< Previous</a></li>';
                } else {
                    $pagination .= ' disabled"><li>< Previous</li>';
                }
                $pagination .= ' </div><ul>';

                if (($page_current >= 7)) {
                    $pagination .= '<li><a href="?offset=0">1</a></li><li>...</li>
                                                        <li><a href="?offset=' . $bef_prev . '">' . $bef_prev . '</a></li>
                                                        <li><a href="?offset=' . $page_prev . '">' . $page_prev . '</a></li>
                                                        <li class="active">' . $page_current . '</li>';


                    if ($page_current < intval($total_pages - 1)) {
                        $pagination .= '<li><a href="?offset=' . $page_next . '">' . $page_next . '</a></li>';
                        if ($aft_next != $total_pages) {
                            $pagination .= '<li><a href="?offset=' . $aft_next . '">' . $aft_next . '</a></li>';
                        }
                    }

                } else {
                    if ($total_pages > 10) {
                        for ($i = 1; $i < 9; $i++) {
                            $pagination .= ($i == $page_current) ? '<li class="active">' . $i . '</li>' : '<a href="?offset=' . $i . '"><li>' . $i . '</li></a>';
                        }
                    } else {
                        for ($i = 1; $i < $total_pages; $i++) {
                            $pagination .= ($i == $page_current) ? '<li class="active">' . $i . '</li>' : '<a href="?offset=' . $i . '"><li>' . $i . '</li></a>';
                        }
                    }


                }

                if ($total_pages > 5 && $page_current < $total_pages && $page_current < ($total_pages - 1)) {
                    $pagination .= '<li>...</li>';
                }


                if ($page_current != $total_pages) {
                    $pagination .= '<a href="?offset=' . $total_pages . '"><li>' . $total_pages . '</li></a>';
                }
                $pagination .= '</ul><div class="btn_next ';

                if ($page_current >= $total_pages) {
                    $pagination .= 'disabled"><li> Next > </li>';
                } else {
                    $pagination .= '"><a href="?offset=' . $page_next . '"><li> Next > </li></a>';
                }
                $pagination .= '</div></section>';

                $html_result .= $pagination;
            }

            return json_encode(
                [
                    'results' => $html_result
                ], JSON_PRETTY_PRINT);
    }

    public function deleteSingle($id)
    {
        return $this->model->deleteSingle($id);
    }

    public function deleteMultiple(string $array_str)
    {
        return $this->model->deleteMultiple($array_str);
    }

    public function create(array $array)
    {
         $this->model->create($array);
    }
    public function setCar(array $array , int $id)
    {
        $this->model->setCar($array , $id);
    }

    public function getSingle(int $id):object
    {
        return $this->model->getSingle($id);
    }

}