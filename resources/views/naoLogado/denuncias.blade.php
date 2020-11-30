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
                    <div class="tituloBarraPrincipal">Denúncia</div>
                    <div>
                        <div style="margin-left:10px; font-size:13px;margin-top:2px; margin-bottom:-15px;color:gray;">Início > Denúncia</div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <div style="width:70px">
                </div>
            </div>
        </div>
    </div>

    <form id="teste" method="POST" action="{{ route('cadastrar.denuncia') }}">
        @csrf

        <div class="barraMenu" style="margin-top:2rem; margin-bottom:4rem;padding:15px;">
            <div class="container" style="margin-top:1rem;">
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label style="font-size:19px;margin-top:10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">INFORMAÇÕES</label>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-warning alert-block fade show">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{$errors->first()}}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block fade show">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{$message}}</strong>
                            </div>
                        @elseif ($message = Session::get('error'))
                            <div class="alert alert-warning alert-block fade show">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{$message}}</strong>
                            </div>
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-4" style="padding-right:15px;">
                                <label class="styleTituloDoInputCadastro" for="nome">Empresa:<span style="color:red">*</span></label>
                                <input class="styleInputCadastro" id="empresa" name="empresa" placeholder="" value="" required>
                            </div>
                            <div class="form-group col-md-4" style="padding-right:15px;">
                                <label class="styleTituloDoInputCadastro" for="email">Endereço:<span style="color:red">*</span></label>
                                <input class="styleInputCadastro" id="endereco" name="endereco" placeholder="" value="" required>
                            </div>
                            <div class="form-group col-md-4" style="padding-right:10px; margin-top:-7px;">
                                <label class="styleTituloDoInputCadastro" for="empresa">Empresas já mapeadas:<span style="color:red">*</span></label>
                                <select class="form-control" name="select_empresa" id="idSelecionarEmpresa" onChange="selecionarArea1(this)">
                                    @foreach ($empresas as $item)
                                        <option value="" disable="" selected="" hidden="">-- Selecionar Empresa --</option>
                                        <option value="{{$item->id}}">{{$item->nome}}</option>
                                    @endforeach
                                    <option value="nenhum">Não Listado</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-row">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="styleTituloDoInputCadastro" for="telefone1">Telefone:</label>
                                    <input class="styleInputCadastro" type="text" id="telefone1" class="form-control" name="telefone" maxlength="11" id="inputEmail4" placeholder="">
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <div class="form col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label style="font-size:19px;margin-top:-10px; margin-bottom:-5px; font-family: 'Roboto', sans-serif;">DENÚNCIA<span style="color:red">*</span></label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-row">
                                    <div class="form-group">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="denuncia"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="padding-top:1rem;padding-bottom:1.5rem;">
                                {{-- <hr size = 7 style="padding-top:1rem;"> --}}
                                <div class="d-flex">
                                    <div class="mr-auto p-2">
                                        <label style="font-weight:bold; color:red; font-family:Arial, Helvetica, sans-serif"><span style="font-size:20px">*</span> campos obrigatórios</label>
                                    </div>
                                <div class="p-2">
                                    <button type="submit" class="btn btn-success" style="width:200px;">Denunciar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>


                </div>

            </div>
        </div>

    </form>

</div>
<script type="text/javascript">
    window.selecionarArea1 = function(){
        //area
        var historySelectList = $('select#idSelecionarEmpresa');
        var $id_empresa = $('option:selected', historySelectList).val();

        if ($id_empresa == 'nenhum') {
                $('#empresa').val('');
                $('#endereco').val('');
                $("#empresa").prop("disabled", false);
                $("#endereco").prop("disabled", false);            
        } else {
            $.ajax({
                url:'{{ config('prefixo.PREFIXO') }}empresa/dados',
                type:"get",
                dataType:'json',
                data: {"id_empresa": $id_empresa},
                success: function(response){
                    console.log(response.endereco);
                    $('#empresa').val(response.nome);
                    $('#endereco').val(response.endereco);
                    // $("#empresa").attr("disabled", true);
                    // $("#endereco").attr("disabled", true);
                    // $('tbody').html(response.table_data);
                    // document.getElementById('idArea');
                }
            });   
        }
    }
</script>
@endsection


