<?php

function customTable($data, $columns, $get_url, $Actions = [])
{
    if (empty($data)) {
        return null;
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
            
            if ($key == 'price' || $key == 'payment_amount' || $key =='payment_change') {
                $value = toIdr($value);
            }
            $html .= '<td class="whitespace-nowrap px-4 py-2 text-gray-700">' . $value . '</td>';
        }
        $html .= '<td class="whitespace-nowrap px-4 py-2 text-gray-700">
                    <div class="flex justify-center items-center gap-2">';
        foreach ($Actions as $action) {
            $actionUrl = str_replace(['{id}'], [$row['id']], $action['url']);
            $html .= '<a href="' . $actionUrl . '" class="rounded-lg px-2 py-1 ' . $action['bgColor'] . ' border hover:' . $action['hoverColor'] . ' transition-all" onclick="' . $action['onclick'] . '">
                        <i class="' . $action['icon'] . ' ' . $action['iconColor'] . '"></i>
                      </a>';
        }

        $html .= '</div></td>';
        $html .= '</tr>';
        $number++;
    }
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';

    return $html;
}

// $extraActions = [
//     [
//         'url' => '?page={get_url}&act=view&id={id}',
//         'bgColor' => 'bg-green-50',
//         'hoverColor' => 'bg-green-100',
//         'icon' => 'bx bx-show',
//         'iconColor' => 'text-green-500',
//         'onclick' => ''  // JavaScript function if needed
//     ]
// ];
