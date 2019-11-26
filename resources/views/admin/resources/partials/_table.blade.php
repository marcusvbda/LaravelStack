<table class="table table-striped hovered resource-table">
    <thead>
        <tr>
            <?php
                $order_type = @$_GET["order_type"]=="desc" ? "asc" : "desc";
                $order_by = @$_GET["order_by"];
                $table = $resource->table();
            ?>
            @foreach($table as $key=>$value)
                <?php
                    $size = @$value['size'] ? $value['size'] : 'auto';
                    $sortble_index = @$value['sortble_index'] ? $value['sortble_index'] : $key;
                ?>
                <th width="{{$size}}">
                    <a  @if(@$value["sortable"]!==false) href="{{ResourcesHelpers::sortLink($resource->route(),request()->query(), $sortble_index,$order_type)}}" @endif
                        class="d-flex flex-row align-items-center link-sortable">
                        <div>{{$value["label"]}}</div>
                        @if(@$value["sortable"]!==false)
                            <div class="ml-auto d-flex flex-row">
                                <span class="sort-icon el-icon-sort-down @if($order_type=='asc' && $order_by==$sortble_index ) active @endif"></span>
                                <span class="sort-icon el-icon-sort-up @if($order_type=='desc' && $order_by==$sortble_index) active @endif"></span>
                            </div>
                        @endif
                    </a>
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                @foreach($table as $key=>$value)
                    <td>
                        @if($key=="code")
                            <a href="{{$resource->route()."/".$row->code}}">{{ $row->code }}</a>
                        @else
                            <?php 
                                $indexes = explode("->",$key);
                                $value = $row;
                                foreach($indexes as $i) {
                                    $value = $value->{$i}; 
                                }
                            ?>
                            {{ $value }}
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>