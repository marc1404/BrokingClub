@extends('layouts.game')

@section('content')
    {{ Fickle::openPanel('Purchase this stock', 6) }}
        {{ QForm::open(['route' => 'purchases.store', 'method' => 'POST']) }}
            @include('partials.forms.purchase')

            <hr/>
            <div class="clearfix">
                <div class="pull-right">
                     {{ QForm::btnPrimary('Purchase', 'shopping-cart') }}
                </div>
            </div>

        {{ QForm::close() }}
    {{ Fickle::closePanel() }}

    {{ Fickle::openPanel('News about '.$stock->name, 6) }}
            <div class="gnews" data-topic="{{ $stock->name }}" >
                <b>Loading news from Google...</b>
            </div>
        {{ Fickle::closePanel() }}

    {{ Fickle::openPanel($stock->name . ' graph', 12) }}


        <div style="height: 550px">
            <!-- TradingView Widget BEGIN -->
            <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
            <script type="text/javascript">
            new TradingView.widget({
              "autosize": true,
              "symbol": "{{ $stock->symbol }}",
              "interval": "D",
              "timezone": "exchange",
              "theme": "White",
              "style": "8",
              "toolbar_bg": "#f1f3f6",
              "allow_symbol_change": true,
              "hideideas": true,
              "show_popup_button": true,
              "popup_width": "1000",
              "popup_height": "650"
            });
            </script>
            <!-- TradingView Widget END -->

        </div>

    {{ Fickle::closePanel() }}








@endsection