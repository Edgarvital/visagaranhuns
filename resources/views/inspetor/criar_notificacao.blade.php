@extends('layouts.app')

@section('content')
<div class="container">
    <div class="barraMenu">
        <div class="d-flex justify-content-center">
            <div class="mr-auto p-2 styleBarraPrincipalMOBILE">
                <a href="javascript: history.go(-1)" style="text-decoration:none;cursor:pointer;color:black;">
                    <div class="btn-group">
                        <div style="margin-top:1px;margin-left:5px;"><img src="{{ asset('/imagens/logo_voltar.png') }}" alt="Logo" style="width:13px;"/></div>
                        <div style="margin-top:2.4px;margin-left:10px;font-size:15px;">Voltar</div>
                    </div>
                </a>
            </div>
            <div class="mr-auto p-2 styleBarraPrincipalPC">
                <div class="form-group">
                    <div class="tituloBarraPrincipal">Notificação</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Programação > Inspeção > Notificação</div>
                    </div>
                </div>
            </div>
            <div class="p-2">
            </div>
        </div>
    </div>

    <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
        <div class="container" style="margin-top:1rem;">
            <div class="form-row">

                <div class="form-group col-md-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block fade show" style="margin-top:1rem;">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">NOTIFICAÇÃO</label>
                        </div>
                        <div class="form col-md-9" style="margin-top:10px;">
                            <form id="form_notificacao_inspetor" method="POST" action="{{ route('save.notificacao') }}">
                                @csrf
                                <input type="hidden" name="inspecao_id" value="{{$inspecao_id}}">
                                <textarea id="summary-ckeditor" rows="40" name="notificacao">{{$notificacao}}</textarea>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr size = 7 style="margin-bottom:-15px;">
            <div class="row" style="margin-top:2rem; margin-bottom:1rem">
                <div class="col-auto mr-auto"></div>
                <div class="col-auto">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAvisoNotificacao_InspetorModal" onclick="salvarNotificacaoInspetor('{{$notificacao}}')">Salvar Notificação</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal aviso-->
<div class="modal fade" id="modalAvisoNotificacao_InspetorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="modalAvisoNotificacao_InspetorCor" class="modal-header" style="background-color:#3ea81f;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" alt="Logo" style=" margin-right:15px;"/><h5 class="modal-title" id="modalAvisoNotificacao_InspetorTitulo" style="font-size:20px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Salvar Notificação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="col-12" ><label id="modalTextoNotificacao_InspetorTexto" style="font-family: 'Roboto', sans-serif;font-weight:bold; margin-bottom:1rem;">Tem certeza que deseja salvar a notificação</label></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"style="width:100px;">Não</button>
                <button id="modalSalvarNotificacao_InspetorBotao" type="button" class="btn btn-success botao-form" onclick="saveNotificacao()">Sim, salvar esta notificação</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>
@endsection