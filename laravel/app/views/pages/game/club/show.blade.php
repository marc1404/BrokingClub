@extends('layouts.game')

@section('content')

    {{ Fickle::openWidget(4, 'setting', 'Club info', 'users') }}
        <ul>
            <li><div class="userHead">
                    <img class="clubAvatar" src="http://stuffpoint.com/spongebob-square-pants/image/164725-spongebob-square-pants-spongebobs-family.jpg"/>
                    <div class="actions">
                          {{ Fickle::iconBtn('envelope', 'default') }}
                          {{ Fickle::iconBtn('plus-square', 'primary') }}
                          {{ Fickle::iconBtn('mortar-board', 'warning') }}
                          {{ Fickle::iconBtn('exclamation-triangle', 'success') }}
                    </div>
                </div>
            </li>
            <li>Clubname: <div class="setting-switch">{{ $club->slug }}</div></li>
            <li>Owner: <div class="setting-switch">{{ $club->owner->firstname }} {{ $club->owner->lastname }}</div></li>
            <li>Teaser: <div class="setting-switch">{{ $club->teaser }}</div></li>
            <li>Description: <div class="setting-switch">{{ $club->description }}</div></li>
            <li>Members: <div class="setting-switch">{{ $club->countMembers() }}</div></li>
            <li>Balance: <div class="setting-switch">{{ $club->worth() }} <small>(Ø {{ $club->avgWorth() }} pp.)</small></div></li>
        </ul>
    {{ Fickle::closeWidget() }}

    {{ Fickle::openPanel('Performance', 8, ['controls' => 'minus,refresh,closepanel', 'padding' => false])}}
        <div id="hero-area"></div>
    {{ Fickle::closePanel() }}

@endsection