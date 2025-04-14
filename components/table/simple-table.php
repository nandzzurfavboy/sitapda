<?php
function baseTable($data, $columns, $get_url, $imageColumns = [])
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
            
            if (in_array($key, $imageColumns) && !empty($value)) {
                $fileExtension = pathinfo($value, PATHINFO_EXTENSION);
                $fileUrl = $value;
                
                if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png'])) {
                    $html .= '<td class="px-4 py-2 text-gray-700">
                        <div class="relative group">
                            <img src="../public/' . $fileUrl . '" alt="Thumbnail" class="h-10 w-10 object-cover rounded cursor-pointer" />
                            <div class="hidden group-hover:flex absolute z-10 top-0 left-0 bg-black bg-opacity-75 p-2 rounded items-center justify-center gap-2">
                                <a href="../public/' . $fileUrl . '" target="_blank" class="text-white hover:text-blue-300">
                                    <i class="bx bx-search-alt text-lg"></i>
                                </a>
                                <a href="../public/' . $fileUrl . '" download class="text-white hover:text-green-300">
                                    <i class="bx bx-download text-lg"></i>
                                </a>
                            </div>
                        </div>
                    </td>';
                } else if (strtolower($fileExtension) == 'pdf') {
                    $html .= '<td class="px-4 py-2 text-gray-700">
                        <div class="relative group">
                            <div class="flex items-center text-red-500 cursor-pointer">
                                <i class="bx bxs-file-pdf text-2xl"></i>
                                <span class="ml-1 text-xs">PDF</span>
                            </div>
                            <div class="hidden group-hover:flex absolute z-10 top-0 left-0 bg-black bg-opacity-75 p-2 rounded items-center justify-center gap-2">
                                <a href="../public/' . $fileUrl . '" target="_blank" class="text-white hover:text-blue-300">
                                    <i class="bx bx-search-alt text-lg"></i>
                                </a>
                                <a href="../public/' . $fileUrl . '" download class="text-white hover:text-green-300">
                                    <i class="bx bx-download text-lg"></i>
                                </a>
                            </div>
                        </div>
                    </td>';
                } else {
                    $html .= '<td class="whitespace-nowrap px-4 py-2 text-gray-700">
                        <span class="text-xs text-gray-500">No file</span>
                    </td>';
                }
            } else {
                $html .= '<td class="whitespace-nowrap px-4 py-2 text-gray-700">' . $value . '</td>';
            }
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
