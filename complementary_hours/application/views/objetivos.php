<?php
    if($espaco){
?>
    <br/><br/><br/>
<?php
    }else{
?>
    <br/>
<?php   
    }

?>
<main role="main" class="container-fluid">
  <div class="jumbotron shadow-sm pt-3">
    <div style="float: right">
        <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" width="270" height="230" style="margin-bottom: 5px"/><br/>
    </div>
    
    <div class="container">
        <h1 class="display-3" style="font-size: 50pt">
            <img class="rounded-circle" src="<?php echo base_url('assets/img/icone/objetivo.png'); ?>" alt="Generic placeholder image" width="100" height="100">
            Objetivos do Projeto!
        </h1>
        <p>
            Veja abaixo o que pretendemos com este projeto!
        </p>
    </div>
    <br>
  </div>

  <div class="container marketing">
    <p class="lead text-justify">
        O, IFNMG - Campus Arinos, oferta vários cursos superiores, nos quais, com o intuito de alcançar a formação e adquirir conhecimento, os alunos devem participar de uma determinada quantidade de horas em atividades complementares, listando cada atividade, num formulário de Controle das Atividades Complementares.
    </p>
    <p class="lead text-justify" >
        Para cada curso, tem um professor coordenador de atividades complementares e seu papel é conferir as informações, certificados e comprovantes das atividades, verificando se as atividades de cada aluno estão de acordo com o quadro de horas das atividades complementares do respectivo curso.
    </p>
    <p class="lead text-justify" >
        Após a conferência das atividades, os coordenadores devem gerar um boletim para cada aluno, registrando a aprovação ou reprovação deste. A partir de então, as informações e certificados do aluno são protocolados e arquivadas em envelopes. O problema do processo atualmente, é tudo isso ser feito de forma manual, desde a entrega dos certificados até o arquivamento.
    </p>
    <p class="lead text-justify" >
        Propõe-se então, a criação de um software, para automatizar todo o processo, uma vez que todos os arquivos enviados pelos alunos serão organizados pelo sistema e também, os boletins serão gerados de forma automática. O sistema deve fornecer informações cruciais para os usuários, tais como: regulamento de horas complementares, quadro de horas complementares, formulário para listagem de certificados, entre outros. Os certificados dos alunos poderão ser anexados ao formulário de horas complementares, em forma de imagens ou arquivos PDF, a fim de que o uso de papel nessa etapa do processo seja eliminado.
    </p>
    <p class="lead text-justify" >
        É necessário também que o sistema mantenha uma segurança de acesso, em que cada usuário tem acesso a determinadas funções, e restrição de outras. Faz-se necessário também, a geração de consultas ou relatórios dos dados dos alunos, a fim de que os alunos possam ficar atentos em relação ao andamento de suas horas complementares.
    </p>
  </div>

  <hr class="featurette-divider">
</main>