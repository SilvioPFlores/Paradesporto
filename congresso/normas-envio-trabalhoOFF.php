<?php
session_start();
include 'config/config.php';
include 'includes/head.php';
getHead($lang['congMenu'], $lang, 'home', 'css/css-congresso.css');
include '../includes/menu.php';
menu($lang['congMenu']);
?>
<div class="container">
    <br>
    <div class="text-center">
        <h4 class="corAzul"> NORMAS PARA SUBMISSÃO DE TRABALHOS </h4>
    </div>
    <div>
        <h6 class="corAzul">DATAS IMPORTANTES</h6>
    </div>
    <div>
        <ul>
            <li>Fim da submissão: 15 de julho de 2024</li>
            <li>Retorno aos autores: 30 de setembro de 2024</li>
            <li>Apresentações: 09 de novembro de 2024</li>
        </ul>
    </div>
    <div>
        <h6 class="corAzul">NORMAS PARA SUBMISSÃO DE TRABALHOS</h6>
    </div>
    <div>
        <p>
            Os participantes são convidados a submeter resumo de trabalhos para uma das áreas temáticas do 
            congresso para apresentação de forma COMUNICAÇÃO ORAL (ao vivo online) ou VÍDEO-PÔSTER (gravado 
            e publicado online), a ser determinado pela comissão científica. A submissão de trabalhos no 
            formato resumo deverá estar conforme as normas apresentadas a seguir e modelo em anexo.
        </p>
    </div>
    <div>
        <h6 class="corAzul">ÁREA TEMÁTICA</h6>
    </div>
    <div>
        <p>O trabalho submetido deve ser identificado para uma das seguintes áreas: </p>
        <ol>
            <li>Iniciação esportiva e modelos de ensino no Paradesporto</li>
            <li>Aperfeiçoamento e caminhos na formação do atleta no Paradesporto;</li>
            <li>Desempenho do atleta do Paradesporto;</li>
            <li>Formação de professores e treinadores no Paradesporto;</li>
            <li>Políticas Públicas para o Paradesporto</li>
            <li>Estudos socioculturais e o Paradesporto</li>
            <li>Avaliação dos atletas no Paradesporto.</li>
        </ol>
    </div>
    <div>
        <h6 class="corAzul">RESUMO</h6>
    </div>
    <div>
        <p>O resumo deverá apresentar:</p>
        <ul>
            <li>
                <strong>TÍTULO:</strong> Deve identificar com clareza a natureza do trabalho.
                 Utilizar no <b>máximo 150</b> caracteres com espaço
            </li>
            <li>
                <strong>AUTOR(ES):</strong> A autoria do trabalho deve ser composta de no mínimo <b>1(um) autor principal 
                e no máximo 5 (cinco) coautores,</b> certifique-se que a ordem dos autores está correta no 
                momento da submissão. Para cada autor deverá ser indicada com numeração sobrescrita a 
                afiliação, cidade, estado e e-mail (este último somente para o autor principal).
                O autor responsável pela apresentação deve estar inscrito no Congresso. Não serão permitidas
                correções posteriores no resumo, na ordem dos autores e nos dados. Cada autor poderá 
                submeter no máximo 2 trabalhos como primeiro autor.
            </li>
            <li>
                <strong>RESUMO:</strong> Deverá seguir o modelo do congresso (em anexo). Todo o arquivo <b>não 
                poderá exceder 2400 caracteres com espaços.</b> Deve ser escrito em parágrafo único, respeitando 
                a estrutura pré-definida (<b>Introdução, Objetivo, Método, Resultados, Conclusão</b>), 
                figuras/imagens/tabelas e citações bibliográficas não são permitidas. As siglas, se necessárias, 
                podem ser utilizadas desde que elas sejam apresentadas no texto.
            </li>
            <li>
                <strong>PALAVRAS-CHAVE:</strong> Devem ser apresentadas no <b>mínimo 2 (duas) e 
                no máximo 5 (cinco)</b> palavras-chaves.
            </li>
        </ul>
        <p>O documento deve ser salvo da seguinte forma: Sobrenome do autor principal, Título do trabalho</p>
        <div class="container">
            <p>Exemplo: SILVA_Iniciacao_ao_paradesporto</p>
            <div>
                <p><a href="../producao/conteudo/CBPP_2024- Modelo Submissão Resumo.docx">
                    <button type="button" class="btn btn-azul">MODELO</button>
                </a></p>
            </div>
        </div>
        <p>
            Todos os resumos aceitos serão publicados nos Anais do 2º CONGRESSO BRASILEIRO DE PEDAGOGIA DO PARADESPORTO, 
            com registro ISSN ou trabalhos aceitos como comunicação oral.
        </p>
    </div>
    <div>
        <h6 class="corAzul">CONDIÇÕES GERAIS PARA A APRESENTAÇÃO DOS TRABALHOS:</h6>
    </div>
    <div>
        <p>
            A definição da forma de apresentação será definida pela Comissão Científica, considerando 
            principalmente a qualidade e pertinência do trabalho na área temática selecionada pelo(s) 
            autor(es). O formato da apresentação será comunicado pelo e-mail indicado na inscrição, e 
            devem seguir as seguintes normas:
        </p>
        <ul>
            <span class="corAzul"><u>VÍDEO-PÔSTER:</u></span>
            <li>Será apresentado no formato online.</li>
            <li>Deve ser apresentado em 4 slides, o modelo será enviado com o aceite para o e-mail cadastrado na submissão.</li>
            <li>Incluir Título do trabalho; autores (primeiro e último nome e respectiva filiação); E-mail para contacto (primeiro autor); Introdução; Objetivos; Materiais e Métodos; Resultados; Conclusões; e Referências.</li>
            <li>A gravação deverá ter no máximo 3 minutos.</li>
            <li>O Vídeo-Pôster deve ser enviado, após o aceite, até o dia <u>20 de outubro de 2024</u> conforme indicado no e-mail de aceite. </li>
            <li>Os vídeos ficarão disponíveis no canal do Congresso no YouTube.</li>
            <span class="corAzul"><u>COMUNICAÇÃO ORAL:</u></span>
            <li>Será apresentado no formato online.</li>
            <li>Deve ser apresentado em no máximo 10 slides, o modelo será enviado com o aceite para o e-mail cadastrado na submissão.</li>
            <li>Incluir: Título do trabalho; autores (primeiro e último nome e respectiva filiação); E-mail para contacto (primeiro autor); Introdução; Objetivos; Materiais e Métodos; Resultados; Conclusões; e Referências.</li>
            <li>A apresentação será de no máximo 10 minutos, seguida de questões.</li>
            <li>Para a apresentação oral o link será enviado por e-mail, e os slides deverão ser enviados até o dia <u>20 de outubro de 2024</u> para o e-mail indicado no aceite.</li>
        </ul>
        <p>
            <u>APRESENTAÇÃO DOS MELHORES TRABALHOS NO DIA 21/11 - PRESENCIAL:</u> Os melhores trabalhos apresentados de 
            forma oral durante a etapa online serão convidados para apresentação durante o evento presencial. 
            O participante é responsável pelas despesas relacionadas a sua participação nessa etapa do evento. 
            Será utilizado o mesmo material (slides) apresentado no formato online. A comunicação dos selecionados 
            acontecerá por e-mail até dia 11/11.
        </p>
    </div>
    <div>
        <h6 class="corAzul">APRESENTAÇÕES NO CONGRESSO</h6>
    </div>
    <div>
        <p>
            Todos os trabalhos serão apresentados (transmitidos) no dia e horário definido pela Comissão Organizadora do Congresso, 
            sendo de responsabilidade do autor que irá apresentar estar presente na sessão (online) para dúvidas e questionamentos.
        </p>
        <p>A submissão irá ocorrer através do link no <a href="https://forms.gle/noPx9tBdfu7cKwWr6">https://forms.gle/noPx9tBdfu7cKwWr6</a></p>
        <p>Quaisquer dúvidas podem ser esclarecidas através do e-mail: <a href="mailto:pedagogia.paradesporto@gmail.com">pedagogia.paradesporto@gmail.com</a></p>
    </div>
    <div>
        <h6 class="corAzul">COMISSÃO CIENTÍFICA</h6>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="corAzul">Coordenação</th>
                    <th scope="col" class="corAzul">Instituição</th>
                    <th scope="col" class="corAzul">Região</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ruth Eugênia Cidade</td>
                    <td>UFPR (Universidade Federal do Paraná)<br>PR/Brasil</td>
                    <td>Sul</td>
                </tr>
                <tr>
                    <td>Elke Lima Trigo</td>
                    <td>SENAC (Centro Universitário Senac - Santo Amaro)<br>SP/Brasil</td>
                    <td>Sudeste</td>
                </tr>
                <tr>
                    <td>Renata Matheus Willig</td>
                    <td>ISEIT de Almada, Instituto Piaget<br>Almada- Portugal</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="corAzul">Membros</th>
                    <th scope="col" class="corAzul">Instituição</th>
                    <th scope="col" class="corAzul">Região</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bruna Barboza Seron</td>
                    <td>UFSC (Universidade Federal de Santa Catarina)<br>SC/Brasil</td>
                    <td>Sul</td>
                </tr>
                <tr>
                    <td>Doralice Lange de Souza</td>
                    <td>UFPR (Universidade Federal do Paraná)<br>PR/Brasil</td>
                    <td>Sul</td>
                </tr>
                <tr>
                    <td>Gabriella Andreeta Figueiredo</td>
                    <td>UNESP (Universidade do Estado de São Paulo, Rio Claro)<br>SP/Brasil</td>
                    <td>Sudeste</td>
                </tr>
                <tr>
                    <td>Luis Felipe Castelli C. Campos</td>
                    <td>UBB (Universidade de Bío-Bío)<br>Chile</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Luiz Gustavo T. F. dos Santos</td>
                    <td>UBB (Universidade de Bío-Bío)<br>Chile</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Mara Jordana Magalhaes Costa</td>
                    <td>UFPI (Universidade Federal do Piauí)<br>PI/Brasil</td>
                    <td>Nordeste</td>
                </tr>
                <tr>
                    <td>Mariana Simões P. Gomes</td>
                    <td>UNIFESP (Universidade Federal de São Paulo)<br>SP/Brasil</td>
                    <td>Sudeste</td>
                </tr>
                <tr>
                    <td>Milena Pedro de Morais</td>
                    <td>UFNT (Universidade Federal do Norte do Tocantins) <br>TO/Brasil</td>
                    <td>Norte</td>
                </tr>
                <tr>
                    <td>Ricardo Antônio Tanhoffer</td>
                    <td>ABRC (Associação Brasileira de Rugby em Cadeira de Rodas)<br>RJ/Brasil</td>
                    <td>Sudeste</td>
                </tr>
                <tr>
                    <td>Rodrigo Rodrigues</td>
                    <td>SARAH (Rede Sarah de Hospitais de Reabilitação, Brasília)<br>DF/Brasil</td>
                    <td>Centro Oeste</td>
                </tr>
                <tr>
                    <td>Saulo Fernandes M. Oliveira</td>
                    <td>UFPE (Universidade Federal de Pernambuco)<br>PE/Brasil</td>
                    <td>Nordeste</td>
                </tr>
                <tr>
                    <td>Vinícius Denardin Cardoso</td>
                    <td>UERR (Universidade Estadual de Roraima)<br>RR/Brasil</td>
                    <td>Norte</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
include 'includes/foot.php';