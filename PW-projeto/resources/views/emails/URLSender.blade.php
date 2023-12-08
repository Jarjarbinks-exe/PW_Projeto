@extends('layouts.simple')

<h3> Olá {{Auth::user()->username}},</h3> <br>

<p> Obrigado por escolher a nossa plataforma para armazenar os seus documentos! </p>
<p> Aqui está o link para o seu documento: <a href="{{ asset('storage/' . $document->file_path) }}"> {{$document->file_path}}</a></p>

Obrigado,<br>
{{ config('app.name') }}

