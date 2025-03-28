<?php
function baseTable($data, $columns, $get_url)
{
    if (empty($data)) {
        return '<p>No data available.</p>';
    }

    $html = '<div class="overflow-x-auto">';
    $html .= '<table id="datatable-style" class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">';
    $html .= '<thead class="ltr:text-left rtl:text-right">';
    $html .= '<tr>';
    $html .= '<th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 w-[1px]">No</th>';
    foreach ($columns as $key => $column) {
        $html .= '<th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">' . $column . '</th>';
    }
    $html .= '<th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 !text-center">Actions</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody class="divide-y divide-gray-200">';

    $number = 1;
    foreach ($data as $row) {
        $html .= '<tr>';
        $html .= '<td class="whitespace-nowrap px-4 py-2 text-gray-700">' . $number . '</td>';
        foreach ($columns as $key => $column) {
            $value = isset($row[$key]) ? $row[$key] : '';
            
            if ($key == 'price' || $key == 'payment_amount') {
                $value = toIdr($value);
            }
            $html .= '<td class="whitespace-nowrap px-4 py-2 text-gray-700">' . $value . '</td>';
        }
        $html .= '<td class="whitespace-nowrap px-4 py-2 text-gray-700">
                    <div class="flex justify-center items-center gap-2">
                    <a href="?page='. $get_url .'&act=edit&id=' . $row['id'] . '" class="rounded-lg px-2 py-1 bg-blue-50 border hover:bg-blue-100 transition-all">
                        <i class="bx bxs-pencil text-blue-500"></i>
                    </a>
                    <a href="?page='. $get_url .'&act=delete&id=' . $row['id'] . '" class="rounded-lg px-2 py-1 bg-red-50 border hover:bg-red-100 transition-all" onclick="return confirm(\'Apakah anda yakin ingin menghapus ini?\')">
                        <i class="bx bxs-trash text-red-500"></i>
                    </a>
                    </div>
                  </td>';
        $html .= '</tr>';
        $number++;
    }
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';

    return $html;
}
