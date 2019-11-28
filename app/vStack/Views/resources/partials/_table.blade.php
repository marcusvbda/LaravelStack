<div class="table-responsive-sm">
    <table class="table table-striped hovered resource-table table-hover mb-0">
        <thead>
            <tr>
                <?php
                    $order_type = @$_GET["order_type"]=="desc" ? "asc" : "desc";
                    $order_by = @$_GET["order_by"];
                    $table = $resource->table();
                ?>
                @foreach($table as $key=>$value)
                    <?php
                        $size = isset($value['size']) ? $value['size'] : 'auto';
                        $sortable_index = isset($value['sortable_index']) ? $value['sortable_index'] : $key;
                    ?>
                    <th width="{{$size}}">
                        <a  @if(@$value["sortable"]!==false) href="{{ResourcesHelpers::sortLink($resource->route(),request()->query(), $sortable_index,$order_type)}}" @endif
                            class="d-flex flex-row align-items-center link-sortable">
                            <div>{{isset($value["label"]) ? @$value["label"] : $value}}</div>
                            @if(@$value["sortable"]!==false)
                                <div class="ml-auto d-flex flex-row">
                                    <span class="sort-icon el-icon-sort-down @if($order_type=='asc' && $order_by==$sortable_index ) active @endif"></span>
                                    <span class="sort-icon el-icon-sort-up @if($order_type=='desc' && $order_by==$sortable_index) active @endif"></span>
                                </div>
                            @endif
                        </a>
                    </th>
                @endforeach
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    @foreach($table as $key=>$value)
                        <td>
                            <?php 
                                $indexes = explode("->",$key);
                                $_val = $row;
                                foreach($indexes as $i) {
                                    $_val = $_val->{$i}; 
                                }
                            ?>
                            {!! @$_val ? $_val : $row->{$value} !!}
                        </td>
                    @endforeach
                    <td>
                        <?php
                            $crud_buttons = [
                                "can_view"     => $resource->canView(),
                                "can_update"   => $resource->canUpdate(),
                                "can_delete"   => $resource->canDelete(),
                                "route_view"   => $resource->route()."/".$row->code,
                                "route_update" => $resource->route()."/".$row->code."/edit",
                                "route_destroy"=> $resource->route()."/".$row->code."/destroy"
                            ];
                        ?>
                        <resource-crud-buttons :data="{{json_encode($crud_buttons)}}" id="{{$row->id}}"></resource-crud-buttons>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>