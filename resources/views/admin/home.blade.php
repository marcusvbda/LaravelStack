@extends("templates.admin")
@section('title',"Home")
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</nav>
@endsection
@section('content')
<h4>Dashboard</h4>

<div class="row">
    <div class="col-12">
        
            <pre>//para criar um novo resource, você precisa executar o comando especificando o do resource, model e tabela, respectivamente</pre>
            <code>php artisan vstack:make-resource {resource} {model} {table}</code>
            
            <pre>//para criar um filtro para o resource</pre>
            <code>php artisan vstack:make-filter {resource} {name} {type}</code>
            <pre>//os tipos de filtro text-filter, select-filter, check-filter, date-filter, rangedate-filter</pre>
            
            <pre>//para criar um resource card metric</pre>
            <code>php artisan vstack:make-metric {resource} {name} {type}</code>
            <pre>//os tipos de metrics custom-content, group-chart, trend-counter, bar-chart, trend-chart</pre>
            
            <pre>//para executar as filas do vstack</pre>
            <code>php artisan queue:work --queue=resource-import,alert-broadcasts</code>
    </div>
</div>
@endsection