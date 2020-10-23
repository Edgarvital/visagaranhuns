@extends('layouts.app')

@section('content')
<div class="container">
    <div class="barraMenu">
        <div class="d-flex">
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
                    <div class="tituloBarraPrincipal">Requerimentos</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Estabelecimento > {{$nome}} > Requerimentos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
        <div class="container" style="margin-top:1rem;">
            <div class="form-row">

                <div class="form-group col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">REQUERIMENTOS</label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Código</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">CNAE</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Requerimento</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($cnaes as $item)
                                        @foreach ($check as $item2)
                                            @if ($item2->status == "pendente")
                                                <tr>
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->codigo}}</th>
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->descricao}}</th>
                                                    <th type="button" class="subtituloBarraPrincipal" onclick="statusCNAERequisicaoRT('criarRequisicao','{{$item->descricao}}',null, '{{$item->id}}', '{{$resptecnico}}', '{{$empresas->id}}')" data-toggle="modal" data-target="#requerimentoCnaeRequisicaoRTModal">Criar</th>
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:black; cursor:pointer;" data-toggle="modal" data-target="#statusPendente">Pendente</th>
                                                </tr>
                                            @elseif ($item2->status == "completo")
                                                <tr>
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->codigo}}</th>
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$item->descricao}}</th>
                                                    <th type="button" class="subtituloBarraPrincipal" onclick="statusCNAERequisicaoRT('criarRequisicao','{{$item->descricao}}',null, '{{$item->id}}', '{{$resptecnico}}', '{{$empresas->id}}')" data-toggle="modal" data-target="#requerimentoCnaeRequisicaoRTModal">Criar</th>
                                                    <th class="subtituloBarraPrincipal" style="font-size:15px; color:black; cursor:pointer;" data-toggle="modal" data-target="#statusCompleto">Completo</th>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label style="font-size:19px;margin-top:5px;margin-bottom:5px; font-family: 'Roboto', sans-serif;">HISTÓRICO</label>
                        </div>
                        <div class="form col-md-12" style="margin-top:-10px;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Código</th>
                                    <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">CNAE</th>
                                      <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Tipo</th>
                                      <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Status</th>
                                      <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Data</th>
                                      <th scope="col" class="subtituloBarraPrincipal" style="font-size:15px; color:black; font-weight:bold">Aviso</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requerimentos as $indice)
                                        @if ($indice->status == "reprovado")
                                            <tr>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->cnae->codigo}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->cnae->descricao}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->tipo}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->status}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->data}}</th>
                                            <th type="button" class="subtituloBarraPrincipal" style="font-size:15px; color:black" onclick="avisoReq('{{$indice->aviso}}')" data-toggle="modal" data-target="#exampleModalCenter">Abrir</th>
                                            </tr>
                                        @else
                                            <tr>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->cnae->codigo}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->cnae->descricao}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->tipo}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->status}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->data}}</th>
                                            <th class="subtituloBarraPrincipal" style="font-size:15px; color:black">{{$indice->aviso}}</th>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Aviso -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2a9df4;">
                    <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Avisos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div id="avisoReq" class="col-12" style="font-family: 'Roboto', sans-serif;"></div>
                    </div>
                </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal - Checklist completo-->
<div class="modal fade" id="statusCompleto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:white;">
                    <img src="{{ asset('/imagens/logo_aprovado.png') }}" width="25px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:#00b300; font-weight:bold; font-family: 'Roboto', sans-serif;">Checklist Completa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;"><label id="descricaoCNAERT" style="font-weight:bold; font-family: 'Roboto', sans-serif;"></label>Os documentos para o checklist deste cnae foram todos anexados.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal - Checklist pendente-->
<div class="modal fade" id="statusPendente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:white;">
                    <img src="{{ asset('/imagens/logo_atencao4.png') }}" width="25px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:#940405; font-weight:bold; font-family: 'Roboto', sans-serif;">Checklist Pendente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" style="font-family: 'Roboto', sans-serif;"><label id="descricaoCNAERTreprovado" style="font-weight:bold; font-family: 'Roboto', sans-serif;"> </label>Algum documento para o checklist deste cnae ainda está pendente!</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal - cnae requerimento-->
<div class="modal fade" id="requerimentoCnaeRequisicaoRTModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#2a9df4;">
                        <img src="{{ asset('/imagens/logo_atencao3.png') }}" width="30px;" alt="Logo" style=" margin-right:15px; margin-top:10px;"/><h5 class="modal-title" id="exampleModalLabel2" style="font-size:20px; margin-top:7px; color:white; font-weight:bold; font-family: 'Roboto', sans-serif;">Criar requerimento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formRequerimento" method="POST" action="{{ route('cadastrar.requerimento') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12" style="font-family: 'Roboto', sans-serif;">Criar requerimento para o CNAE <label id="criarRequerimentoCNAERT" style="font-weight:bold; font-family: 'Roboto', sans-serif;"> </label> ?</div>

                            <div class="col-12" style="font-family: 'Roboto', sans-serif; margin-top:10px;">
                                {{-- <input type="hidden" name="resptecnico" value="{{$resptecnico}}"> --}}
                                <input type="hidden" name="empresa" value="{{$empresas->id}}">
                                <input type="hidden" name="cnae" id="idCnaeRequerimentoRT">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Tipo de requerimento</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="tipo">
                                        <option id="priLicenca" value="Primeira Licenca">Primeira Licença</option>
                                        <option id="renoLicenca" value="Renovacao">Renovação</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"style="width:200px;">Cancelar</button>
                        <button type="submit" class="btn btn-success" style="width:200px;">Sim, criar requerimento</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
@endsection