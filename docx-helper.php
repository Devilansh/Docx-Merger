<?php
if (isset($_POST['data']) && !empty($_POST['data'])) {
    foreach (json_decode($_POST['data']) as $key => $value) {
        echo '<tr>
                    <td class="domain_name"><img data-name="' . $value->domain . '" src="' . $value->icon . '">' . str_replace('.com', '', $value->domain) . '</td>
                    <td>' . $value->id . '</td>
                    <td>' . $value->datetime . '</td>
                    <td>' . $value->status . '</td>';
        echo '<td>';
        foreach ($value->product as $k => $v) {
            echo '<img width="50" src="' . $v->thumbnail . '"><br>';
        }
        echo '</td>';
        echo '<td>';
        foreach ($value->product as $k => $v) {
            echo '<p class="pname" data-id="' . $v->id . '" data-toggle="modal" data-target="#exampleModalCenter">' . $v->name . '</p><br>';
        }
        echo '</td>';
        echo '<td>';
        foreach ($value->product as $k => $v) {
            echo '<p>' . $v->book_avail[0] . ',' . $v->book_avail[1] . '</p><br>';
        }
        echo '</td>';
        echo '<td>';
        foreach ($value->product as $k => $v) {
            echo '<p>' . $v->price . '</p><br>';
        }
        echo '</td>';
        echo '<td>';
        foreach ($value->product as $k => $v) {
            echo '<p>' . $v->quantity . '</p><br>';
        }
        echo '</td>';
        echo '<td>' . $value->total . '</td>
                    </tr>';
    }
}
