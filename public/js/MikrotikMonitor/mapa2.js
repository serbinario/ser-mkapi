var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];
var hotelMarkers;

// fake JSON call
function getJSONMarkers() {
    const markers = [
        {
            "QTD": 1,
            "SETOR": "PREFEITURA",
            "PONTO": "SEC. DE FINANÇAS",
            "ENDEREÇO": "R. DOM BARRETO, S/N - CENTRO",
            "COORDENADAS": "-7.832914, -34.906000"
        },
        {
            "QTD": 2,
            "SETOR": "PREFEITURA",
            "PONTO": "ADMINISTRAÇÃO",
            "ENDEREÇO": "R. DOM BARRETO, S/N - CENTRO",
            "COORDENADAS": "-7.832924, -34.906243"
        },
        {
            "QTD": 3,
            "SETOR": "PREFEITURA",
            "PONTO": "HABITAÇÃO",
            "ENDEREÇO": "R. DOM BARRETO, 14 - CENTRO",
            "COORDENADAS": "-7.833252, -34.905473"
        },
        {
            "QTD": 4,
            "SETOR": "PREFEITURA",
            "PONTO": "PLANEJAMENTO",
            "ENDEREÇO": "R. DOM BARRETO, 80 - CENTRO",
            "COORDENADAS": "-7.832660, -34.906260"
        },
        {
            "QTD": 5,
            "SETOR": "PREFEITURA",
            "PONTO": "AÇÃO SOCIAL",
            "ENDEREÇO": "R. DOM BARRETO, 92 - CENTRO",
            "COORDENADAS": "-7.832660, -34.906260"
        },
        {
            "QTD": 6,
            "SETOR": "PREFEITURA",
            "PONTO": "JUNTA MILITAR",
            "ENDEREÇO": "R. DOM BARRETO, 5 - CENTRO",
            "COORDENADAS": "-7.832660, -34.906260"
        },
        {
            "QTD": 7,
            "SETOR": "PREFEITURA",
            "PONTO": "CERTAMES",
            "ENDEREÇO": "R. DOM BARRETO - CENTRO",
            "COORDENADAS": "-7.832660, -34.906260"
        },
        {
            "QTD": 8,
            "SETOR": "PREFEITURA",
            "PONTO": "GABINETE",
            "ENDEREÇO": "R. JOAQUIM NABUCO, 120 - CENTRO",
            "COORDENADAS": "-7.832618, -34.906239"
        },
        {
            "QTD": 9,
            "SETOR": "PREFEITURA",
            "PONTO": "COMUNICAÇÃO",
            "ENDEREÇO": "R. JOAQUIM NABUCO, 120 - CENTRO",
            "COORDENADAS": "-7.832618, -34.906239"
        },
        {
            "QTD": 10,
            "SETOR": "PREFEITURA",
            "PONTO": "RECEITA",
            "ENDEREÇO": "R. JOAQUIM NABUCO, 22  - CENTRO",
            "COORDENADAS": "-7.831677, -34.908104"
        },
        {
            "QTD": 11,
            "SETOR": "PREFEITURA",
            "PONTO": "CONTROLADORIA",
            "ENDEREÇO": "R. JOAQUIM NABUCO, 120 - CENTRO",
            "COORDENADAS": "-7.832618, -34.906239"
        },
        {
            "QTD": 12,
            "SETOR": "PREFEITURA",
            "PONTO": "ARQUIVOS",
            "ENDEREÇO": "R. JOAQUIM NABUCO, 120 - CENTRO",
            "COORDENADAS": "-7.832618, -34.906239"
        },
        {
            "QTD": 13,
            "SETOR": "PREFEITURA",
            "PONTO": "PATRIMÔNIO",
            "ENDEREÇO": "R. JOAQUIM NABUCO - CENTRO",
            "COORDENADAS": "-7.831677, -34.908104"
        },
        {
            "QTD": 14,
            "SETOR": "PREFEITURA",
            "PONTO": "SEC. DE GOVERNO",
            "ENDEREÇO": "R. JOAQUIM NABUCO, 120 - CENTRO",
            "COORDENADAS": "-7.832618, -34.906239"
        },
        {
            "QTD": 15,
            "SETOR": "PREFEITURA",
            "PONTO": "TURISMO",
            "ENDEREÇO": "R. BARBOSA LIMA, 2-132 - CENTRO",
            "COORDENADAS": "-7.832855, -34.905519"
        },
        {
            "QTD": 16,
            "SETOR": "PREFEITURA",
            "PONTO": "EVENTOS",
            "ENDEREÇO": "AV. DIPER, N, 17 - AREIA BRANCA",
            "COORDENADAS": "-7.842386, -34.907934"
        },
        {
            "QTD": 17,
            "SETOR": "PREFEITURA",
            "PONTO": "INFRA ESTRUTURA",
            "ENDEREÇO": "R. SEVERINO UCHÔA CAVALCANTE, 151 - CENTRO",
            "COORDENADAS": "-7.831940,-34.908140"
        },
        {
            "QTD": 18,
            "SETOR": "PREFEITURA",
            "PONTO": "URBI",
            "ENDEREÇO": "AV. VINTE E SETE DE SETEMBRO, 292 - CENTRO",
            "COORDENADAS": "-7.839430,-34.906430"
        },
        {
            "QTD": 19,
            "SETOR": "PREFEITURA",
            "PONTO": "CONSELHO TUTELAR IGARASSU",
            "ENDEREÇO": "R. JOAQUIM NABUCO, 120 - CENTRO",
            "COORDENADAS": "-7.830843, -34.908630"
        },
        {
            "QTD": 20,
            "SETOR": "PREFEITURA",
            "PONTO": "GARAGEM",
            "ENDEREÇO": "R. SEVERINO UCHÔA CAVALCANTE, S/N - CENTRO",
            "COORDENADAS": "-7.831940,-34.908140"
        },
        {
            "QTD": 21,
            "SETOR": "PREFEITURA",
            "PONTO": "DEFESA CIVIL",
            "ENDEREÇO": "AV. VINTE E SETE DE SETEMBRO, 104 - CENTRO",
            "COORDENADAS": "-7.831183, -34.909641"
        },
        {
            "QTD": 22,
            "SETOR": "PREFEITURA",
            "PONTO": "CEFOPI",
            "ENDEREÇO": "AV. DIPER, 74 - SARAMANDAIA",
            "COORDENADAS": "-7.841918, -34.909715"
        },
        {
            "QTD": 23,
            "SETOR": "PREFEITURA",
            "PONTO": "GUARDAS",
            "ENDEREÇO": "RUA BERNARDO VIEIRA MELO - CENTRO",
            "COORDENADAS": "-7.833550,-34.906330"
        },
        {
            "QTD": 24,
            "SETOR": "PREFEITURA",
            "PONTO": "CONSELHO TUTELAR CRUZ",
            "ENDEREÇO": "RUA DOUTOR AGUSTO VAZ, 260 - CRUZ DE REBOUÇAS",
            "COORDENADAS": "-7.871743, -34.908981"
        },
        {
            "QTD": 25,
            "SETOR": "PREFEITURA",
            "PONTO": "ARTICULAÇÃO SOCIAL",
            "ENDEREÇO": "R. DOM BARRETO - CENTRO",
            "COORDENADAS": "-7.832586, -34.906239"
        },
        {
            "QTD": 26,
            "SETOR": "PREFEITURA",
            "PONTO": "CENTRO DE ARTES",
            "ENDEREÇO": "R. SEVERINO UCHÔA CAVALCANTE, 1 - CENTRO",
            "COORDENADAS": "-7.831778, -34.908198"
        },
        {
            "QTD": 27,
            "SETOR": "PREFEITURA",
            "PONTO": "CASA DOS CONSELHOS",
            "ENDEREÇO": "RUA LUIZ GONZAGA MENEZES - SARAMANDAIA",
            "COORDENADAS": "-7.840943, -34.908866"
        },
        {
            "QTD": 28,
            "SETOR": "PREFEITURA",
            "PONTO": "SEC. DE DESENVOLVIMENTO ECONÔMICO",
            "ENDEREÇO": "R. MADALENA, 25 - CENTRO",
            "COORDENADAS": "-7.828432, -34.910168"
        },
        {
            "QTD": 29,
            "SETOR": "PREFEITURA",
            "PONTO": "DEPATRAN",
            "ENDEREÇO": "R. MADALENA, 25 - CENTRO",
            "COORDENADAS": "-7.828432, -34.910168"
        },
        {
            "QTD": 30,
            "SETOR": "PREFEITURA",
            "PONTO": "AGENCIA DE DESENVOLVIMENTO ECONOMIGO",
            "ENDEREÇO": "R. MADALENA, 36- CENTRO",
            "COORDENADAS": "-7.828875, -34.912443"
        },
        {
            "QTD": 31,
            "SETOR": "PREFEITURA",
            "PONTO": "MEIO AMBIENTE",
            "ENDEREÇO": "R. SANTINA, GOMES DE ANDRADE, 168 - CENTRO",
            "COORDENADAS": "-7.825977, -34.904408"
        },
        {
            "QTD": 32,
            "SETOR": "PREFEITURA",
            "PONTO": "CASA DO ARTESÃO",
            "ENDEREÇO": "R. BARBOSA LIMA, 136 - CENTRO",
            "COORDENADAS": "-7.834527, -34.906816"
        },
        {
            "QTD": 33,
            "SETOR": "PREFEITURA",
            "PONTO": "BOLSA FAMÍLIA IGARASSU",
            "ENDEREÇO": "R. SANTINA, GOMES DE ANDRADE, 230 - CENTRO",
            "COORDENADAS": "-7.827318, -34.907315"
        },
        {
            "QTD": 34,
            "SETOR": "PREFEITURA",
            "PONTO": "CRAS DE IGARASSU",
            "ENDEREÇO": "R. SANTINA, GOMES DE ANDRADE, 230 - CENTRO",
            "COORDENADAS": "-7.827318, -34.907315"
        },
        {
            "QTD": 35,
            "SETOR": "PREFEITURA",
            "PONTO": "CREAS IGARASSU",
            "ENDEREÇO": "R. SALATIEL FRUTOS DE MACÊDO, 226 - CENTRO",
            "COORDENADAS": "-7.826028, -34.906255"
        },
        {
            "QTD": 36,
            "SETOR": "PREFEITURA",
            "PONTO": "PROCURADORIA IGARASSU",
            "ENDEREÇO": "AV. DUARTE COELHO, 151 - CAMPINA DE FEIRA",
            "COORDENADAS": "-7.829020,-34.909320"
        },
        {
            "QTD": 37,
            "SETOR": "PREFEITURA",
            "PONTO": "TRIBUTAÇÃO",
            "ENDEREÇO": "R. DOM BARRETO, S/N - CENTRO",
            "COORDENADAS": "-7.832660, -34.906260"
        },
        {
            "QTD": 38,
            "SETOR": "PREFEITURA",
            "PONTO": "SEC. DA MULHER",
            "ENDEREÇO": "RUA JOAQUIM NABUCO, 90 - CENTRO",
            "COORDENADAS": "-7.831059, -34.908502"
        },
        {
            "QTD": 39,
            "SETOR": "PREFEITURA",
            "PONTO": "COLÔNIA DE PESCADORES",
            "ENDEREÇO": "R. MADALENA - S/N CENTRO",
            "COORDENADAS": "-7.828979, -34.911999"
        },
        {
            "QTD": 40,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ABERTA PAULO FREIRE",
            "ENDEREÇO": "ESTRADA DO MANJOPE, S/N- LOT AGAM. MAGALHÃES II ",
            "COORDENADAS": "-7.863830,-34.914920"
        },
        {
            "QTD": 41,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ADOLFO BROL",
            "ENDEREÇO": "RUA STELIO MARINHO FALCAO, SN - CENTRO",
            "COORDENADAS": "-7.837890,-34.910600"
        },
        {
            "QTD": 42,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ALBIN STAHLI",
            "ENDEREÇO": "AVENIDA RUBINA, 222 - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.881280,-34.907001"
        },
        {
            "QTD": 43,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ANA BANDEIRA DE MENESES",
            "ENDEREÇO": "LOTEAMENTO MARCO DE PEDRA, SN - SITIO DOS MARCOS",
            "COORDENADAS": "-7.813180,-34.896252"
        },
        {
            "QTD": 44,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ANA CALDAS BRANDAO",
            "ENDEREÇO": "RUA SAO JOAO BATISTA, SN - CUEIRAS",
            "COORDENADAS": "-7.860712,-34.880283"
        },
        {
            "QTD": 45,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ANTONIO DE PADUA CARACIOLO",
            "ENDEREÇO": "RUA VERDEJANTE, S/N LOT STO. ANTONIO - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.854190,-34.910910"
        },
        {
            "QTD": 46,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ARTUR CARLOS DE MELO",
            "ENDEREÇO": "AVENIDA VINTE SETE DE SETEMBRO, SN - CENTRO",
            "COORDENADAS": "-7.843250,-34.907580"
        },
        {
            "QTD": 47,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "BIBLIOTECA PUBLICA MUNICIPAL",
            "ENDEREÇO": "R. BARBOSA LIMA - CENTRO",
            "COORDENADAS": "-7.835760,-34.907520"
        },
        {
            "QTD": 48,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "CECILIA MARIA VAZ CURADO RIBEIRO",
            "ENDEREÇO": "AV HENRIQUE DIAS, SN - LOT AGAMENON MAGALHAES",
            "COORDENADAS": "-7.836377,-34.922482"
        },
        {
            "QTD": 49,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "CRECHE TIA EMOCY KRAUSE",
            "ENDEREÇO": "AV. BARAO DE VERA CRUZ, SN - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.879410,-34.905260"
        },
        {
            "QTD": 50,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "CRECHE TIA JANE MAGALHAES",
            "ENDEREÇO": "RUA SEVERINO UCHOA CAVALCANTE, SN - CENTRO",
            "COORDENADAS": "-7.831940,-34.908138"
        },
        {
            "QTD": 51,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "CREEI CENTRO DE REABILITACAO",
            "ENDEREÇO": "R. MARIA HAIDÊ, 22 - CAMPINA DE FEIRA",
            "COORDENADAS": "-7.831940,-34.908140"
        },
        {
            "QTD": 52,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "DALILA DE MELO FONSECA",
            "ENDEREÇO": "RUA JOAO FRANCISCO RIBEIRO, SN - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.871920,-34.903610"
        },
        {
            "QTD": 53,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "DIEGO DE SA LEITAO",
            "ENDEREÇO": "SITIO ENGENHO NOVO CAMBOA, S/N - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.864350,-34.898350"
        },
        {
            "QTD": 54,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ECILDA RAMOS DE SOUZA",
            "ENDEREÇO": "LOT ALTO DO PANCO, SN - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.866320,-34.896990"
        },
        {
            "QTD": 55,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "EDUARDO VIEIRA DE CARVALHO",
            "ENDEREÇO": "GRANJA ARAGARCAS, SN SN - TABULEIRO",
            "COORDENADAS": "-7.848858,-34.986493"
        },
        {
            "QTD": 56,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "EVANGELINA DELGADO DE ALBUQUERQUE",
            "ENDEREÇO": "RUA SANTA CRUZ, SN - TRES LADEIRAS",
            "COORDENADAS": "-7.760346,-35.031350"
        },
        {
            "QTD": 57,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "FLAVIO PESSOA GUERRA",
            "ENDEREÇO": "RUA FERA FERIDA, LOT. ENCANTO IGARASSU, SN - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.872930,-34.909440"
        },
        {
            "QTD": 58,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "FRANCISCO SIMOES DA COSTA",
            "ENDEREÇO": "RUA OIAPOQUE, SN - ALTO DO CEU",
            "COORDENADAS": "-7.806357,-34.932498"
        },
        {
            "QTD": 59,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "IRINEU MARQUES FONSECA",
            "ENDEREÇO": "RUA SANTA CRUZ, - TRES LADEIRAS",
            "COORDENADAS": "-7.760346,-35.031350"
        },
        {
            "QTD": 60,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "JOAO ALBUQUERQUE UCHOA CAVALCANTI",
            "ENDEREÇO": "CHA DO AMBROSIO, SN - LOTEAMENTO JABACO",
            "COORDENADAS": "-7.830049, -34.927981"
        },
        {
            "QTD": 61,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "JOAO BATISTA DE FRAGA",
            "ENDEREÇO": "SITIO GUERERE, SN - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.857887, -34.884660"
        },
        {
            "QTD": 62,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "JOAO LEITE NOGUEIRA PAZ",
            "ENDEREÇO": "RUA MARIA ELIZABETE SOARES DE LIRA, SN RUBINA - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.880350, -34.906275"
        },
        {
            "QTD": 63,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "JOAO DE QUEIROZ GALVAO ",
            "ENDEREÇO": "AV BEIRA MAR, SN - CENTRO",
            "COORDENADAS": "-7.824327, -34.905872"
        },
        {
            "QTD": 64,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "JOAO SANTOS FILHO",
            "ENDEREÇO": "RUA DO CASARAO, SN - NOVA CRUZ",
            "COORDENADAS": "-7.847187, -34.845908"
        },
        {
            "QTD": 65,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "JOSE JORGE FARIAS SALES",
            "ENDEREÇO": "RUA MARIA CORREIA DE MORAIS, S/N - VILA DA FACHESF",
            "COORDENADAS": "-7.839415, -34.901648"
        },
        {
            "QTD": 66,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "JOSE LUIZ DE BARROS SAMPAIO",
            "ENDEREÇO": "SITIO PIRAJUI, SN - NOVA CRUZ",
            "COORDENADAS": "-7.849133, -34.845625"
        },
        {
            "QTD": 67,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "JOSE MARTINS DO CARMO",
            "ENDEREÇO": "AV ERASMO MARTINS, S/N - CENTRO",
            "COORDENADAS": "-7.817841, -34.920566"
        },
        {
            "QTD": 68,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "MARIA AMELIA DE AS LEITAO",
            "ENDEREÇO": "RUA JOAO ALFREDO, 29 - NOVA CRUZ",
            "COORDENADAS": "-7.850620, -34.843280"
        },
        {
            "QTD": 69,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "MARIA DA GLORIA ALVES DE LIMA",
            "ENDEREÇO": "RUA GRAVATA, SN MONJOPE - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.868885, -34.919662"
        },
        {
            "QTD": 70,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "MARIA DO CARMO DO REGO MONTEIRO",
            "ENDEREÇO": "R. NOVO IGARAÇU, 66-128 - BELA VISTA",
            "COORDENADAS": "-7.825928, -34.918656"
        },
        {
            "QTD": 71,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "MARIA DJANIRA LACERDA LEITE ",
            "ENDEREÇO": "AV BELO HORIZONTE, SN - VILA RURAL",
            "COORDENADAS": "-7.809571, -34.929325"
        },
        {
            "QTD": 72,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "MARIA JOSE DO AMARAL",
            "ENDEREÇO": "LOTEAMENTO SANTAREM, SN - CENTRO",
            "COORDENADAS": "-7.829498, -34.916847"
        },
        {
            "QTD": 73,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "MARIA LUCIA DA SILVA ",
            "ENDEREÇO": "RUA PROFESSOR BRUNO MAIA, SN - LOTEAMENTO JACOCA",
            "COORDENADAS": "-7.812457, -34.935294"
        },
        {
            "QTD": 74,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "MIGUEL GOMES DE LIMA",
            "ENDEREÇO": "ESTRADA COMERCIAL DA PITANGA, S/N - AGAMENON MAGALHÃES",
            "COORDENADAS": "-7.840655, -34.927046"
        },
        {
            "QTD": 75,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "NELSON DE OLIVEIRA GALVAO ",
            "ENDEREÇO": "VILA NOSSA SENHORA DE FATIMA, SN - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.873723, -34.916514"
        },
        {
            "QTD": 76,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "NOSSA SENHORA DA CONCEICAO ",
            "ENDEREÇO": "RUA DA LAVADEIRA, 4 - CENTRO",
            "COORDENADAS": "-7.833569, -34.915103"
        },
        {
            "QTD": 77,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ORFANATO SANTO ANTONIO ",
            "ENDEREÇO": "RUA BARBOSA LIMA, SN - CENTRO",
            "COORDENADAS": "-7.834005, -34.906019"
        },
        {
            "QTD": 78,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "PASTOR ISAIAS RAFAEL DE ALENCAR",
            "ENDEREÇO": "RUA JOSE LACERDA LEITE, SN - CENTRO",
            "COORDENADAS": "-7.827032, -34.914275"
        },
        {
            "QTD": 79,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "PROFESSOR EDUARDO DE BRITO",
            "ENDEREÇO": "RODOVIA MARIO MELO, SN - CENTRO",
            "COORDENADAS": "-7.818301, -34.906008"
        },
        {
            "QTD": 80,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "PROFESSOR JOSE ERONILDES ",
            "ENDEREÇO": "AV VALDEMAR LUIZ DO NASCIMENTO - TABATINGA",
            "COORDENADAS": "-7.806884, -34.915874"
        },
        {
            "QTD": 81,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "SAMUEL RAIMUNDO DE LIMA",
            "ENDEREÇO": "SITIO SANTA CRUZ, 5 - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.865527, -34.898166"
        },
        {
            "QTD": 82,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "SÃO LUIZ",
            "ENDEREÇO": "SITIO INHAMA, SN - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.884316, -34.893907"
        },
        {
            "QTD": 83,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "SÃO MARCOS",
            "ENDEREÇO": "RUA SANTA RITA, SN - LOTEAMENTO SAO MARCOS",
            "COORDENADAS": "-7.809343, -34.915814"
        },
        {
            "QTD": 84,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "SENADOR JOSE HERMINIO DE MORAES",
            "ENDEREÇO": "RUA SANTA BARBARA, SN - LOT ANA DE ALBUQUERQUE",
            "COORDENADAS": "-7.846403, -34.913602"
        },
        {
            "QTD": 85,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "SOLDADO MARIANO MARCOS GONCALVES",
            "ENDEREÇO": "RUA DO CAJA, SN - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.874303, -34.907299"
        },
        {
            "QTD": 86,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "ULISSES PERNAMBUCANO",
            "ENDEREÇO": "POV.TERRA NOSSA, SN - PAU DE LEGUA",
            "COORDENADAS": "-7.874843, -34.928427"
        },
        {
            "QTD": 87,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "VEREADOR JAIME DA BEZERRA ",
            "ENDEREÇO": "RUA DA BONDADE, SN - JARDIM NOVO PARISO",
            "COORDENADAS": "-7.821307, -34.913210"
        },
        {
            "QTD": 88,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "VEREADOR JOSE FRANCISCO FERREIRA",
            "ENDEREÇO": "AV BARAO DE VERA CRUZ, 246 - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.865410, -34.907068"
        },
        {
            "QTD": 89,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "VIRGINIA BORBA PESSOA GUERRA ",
            "ENDEREÇO": "SITIO COLONIA PAU DE LEGUA, SN - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.861757, -34.910809"
        },
        {
            "QTD": 90,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "YARA RIBEIRO DE ALBUQUERQUE ",
            "ENDEREÇO": "LOTEAMENTO BEIRA MAR II, SN - CENTRO",
            "COORDENADAS": "-7.827846, -34.898707"
        },
        {
            "QTD": 91,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "SECRETARIA DE EDUCACAO  ",
            "ENDEREÇO": "R. MARIA HAIDÊ, 22 - CAMPINA DE FEIRA",
            "COORDENADAS": "-7.825255, -34.912808"
        },
        {
            "QTD": 92,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "NÚCLEO DE TEC. E FORM. DE PROF. (SAGRADO CORAÇÃO DE JESUS)",
            "ENDEREÇO": "AV. DIPER, 74 - SARAMANDAIA",
            "COORDENADAS": "-7.842195, -34.909683"
        },
        {
            "QTD": 93,
            "SETOR": "EDUCAÇÃO",
            "PONTO": "BIBLIOTECA SESI DE CRUZ",
            "ENDEREÇO": "AV. RUBINA, 366-432, SANTA LUZIA - CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.879359, -34.908425"
        },
        {
            "QTD": 94,
            "SETOR": "SAÚDE",
            "PONTO": "AGAMENON I",
            "ENDEREÇO": "RUA HENRIQUE DIAS – CENTRO",
            "COORDENADAS": "-7.829144, -34.922428"
        },
        {
            "QTD": 95,
            "SETOR": "SAÚDE",
            "PONTO": "BELA VISTA ",
            "ENDEREÇO": "AV HERCULANO BANDEIRA – CENTRO",
            "COORDENADAS": "-7.821544, -34.927332"
        },
        {
            "QTD": 96,
            "SETOR": "SAÚDE",
            "PONTO": "BEIRA MAR II",
            "ENDEREÇO": "RUA BEIRA MAR II – CENTRO",
            "COORDENADAS": "-7.830854, -34.901084"
        },
        {
            "QTD": 97,
            "SETOR": "SAÚDE",
            "PONTO": "MANACIAL",
            "ENDEREÇO": "RUA MANANCIAL – CENTRO",
            "COORDENADAS": "-7.840384, -34.903954"
        },
        {
            "QTD": 98,
            "SETOR": "SAÚDE",
            "PONTO": "MONTA",
            "ENDEREÇO": "RUA AUSTRIA – CENTRO",
            "COORDENADAS": "-7.843130, -34.905558"
        },
        {
            "QTD": 99,
            "SETOR": "SAÚDE",
            "PONTO": "NOSSA SENHORA DA CONCEIÇÃO",
            "ENDEREÇO": "RUA AZULAO – LOT. N. SR DA CONCEIÇÃO",
            "COORDENADAS": "-7.834677, -34.918345"
        },
        {
            "QTD": 100,
            "SETOR": "SAÚDE",
            "PONTO": "REDENÇÃO",
            "ENDEREÇO": "RUA LUMINASA – VILA EBENEZER",
            "COORDENADAS": "-7.827957, -34.901880"
        },
        {
            "QTD": 101,
            "SETOR": "SAÚDE",
            "PONTO": "TAÉPE",
            "ENDEREÇO": "RUA RUBENS MARTINS BERTA – TAEPE",
            "COORDENADAS": "-7.825988, -34.912672"
        },
        {
            "QTD": 102,
            "SETOR": "SAÚDE",
            "PONTO": "BEIRA MAR I",
            "ENDEREÇO": "RUA EDGAR LINS – CENTRO",
            "COORDENADAS": "-7.827513, -34.903781"
        },
        {
            "QTD": 103,
            "SETOR": "SAÚDE",
            "PONTO": "BOA VISTA ",
            "ENDEREÇO": "ENTRADA DA UINA – SITIO BOA ",
            "COORDENADAS": "-7.834965, -34.907209"
        },
        {
            "QTD": 104,
            "SETOR": "SAÚDE",
            "PONTO": "SÃO MARCOS",
            "ENDEREÇO": "RUA JAU – LOT SAO MARCOS",
            "COORDENADAS": "-7.818510, -34.904919"
        },
        {
            "QTD": 105,
            "SETOR": "SAÚDE",
            "PONTO": "TABATINGA",
            "ENDEREÇO": "AVENIDA VALDEMAR NASCIMENTO – CENTRO",
            "COORDENADAS": "-7.820665, -34.913878"
        },
        {
            "QTD": 106,
            "SETOR": "SAÚDE",
            "PONTO": "ALTO DO CÉU",
            "ENDEREÇO": "RUA PONTA GROSSA – VILA RURAL",
            "COORDENADAS": "-7.813535, -34.930027"
        },
        {
            "QTD": 107,
            "SETOR": "SAÚDE",
            "PONTO": "VILA RURAL",
            "ENDEREÇO": "VILA RURAL – VILA RURAL",
            "COORDENADAS": "-7.813535, -34.930027"
        },
        {
            "QTD": 108,
            "SETOR": "SAÚDE",
            "PONTO": "AGAMENON II",
            "ENDEREÇO": "LOT AGAMENON II – CENTRO",
            "COORDENADAS": "-7.863827, -34.914890"
        },
        {
            "QTD": 109,
            "SETOR": "SAÚDE",
            "PONTO": "ENCANTO IGARASSU",
            "ENDEREÇO": "RUA FIM DE SEMANA – CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.855611, -34.905166"
        },
        {
            "QTD": 110,
            "SETOR": "SAÚDE",
            "PONTO": "MAGDA COSTA",
            "ENDEREÇO": "RUIA RODRIGUES DE FRAGA – CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.871011, -34.908422"
        },
        {
            "QTD": 111,
            "SETOR": "SAÚDE",
            "PONTO": "SANTO ANTONIO ",
            "ENDEREÇO": "RUA OURICURI – CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.857878, -34.910580"
        },
        {
            "QTD": 112,
            "SETOR": "SAÚDE",
            "PONTO": "SITIO LIRA",
            "ENDEREÇO": "RUA ALFREDO VIEIRA – CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.870343, -34.902957"
        },
        {
            "QTD": 113,
            "SETOR": "SAÚDE",
            "PONTO": "ANA DE ALBUQUERQUE",
            "ENDEREÇO": "RUA MATO GROSSO – LOTANA ALBUQUERQUE",
            "COORDENADAS": "-7.848296, -34.912303"
        },
        {
            "QTD": 114,
            "SETOR": "SAÚDE",
            "PONTO": "INHAMÃ",
            "ENDEREÇO": "AVENIDA 2 – CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.881693, -34.901691"
        },
        {
            "QTD": 115,
            "SETOR": "SAÚDE",
            "PONTO": "NOVA CRUZ I",
            "ENDEREÇO": "RUA SAO JOSE – BOM RETIRO",
            "COORDENADAS": "-7.874517, -34.908180"
        },
        {
            "QTD": 116,
            "SETOR": "SAÚDE",
            "PONTO": "CTA",
            "ENDEREÇO": "RUA TENENTE PEDRO ALVES, 184, CRUZ DE REBOUÇAS",
            "COORDENADAS": "-7.871580, -34.907955"
        },
        {
            "QTD": 117,
            "SETOR": "SAÚDE",
            "PONTO": "SECRETARIA DE SAÚDE",
            "ENDEREÇO": "AV DUARTE COELHO, 183 - CENTRO",
            "COORDENADAS": "-7.826819, -34.910816"
        },
        {
            "QTD": 118,
            "SETOR": "SAÚDE",
            "PONTO": "REGULAÇAO DA SEC. DE SAÚDE",
            "ENDEREÇO": "R. JOAQUIM NABUCO, 203 - CENTRO",
            "COORDENADAS": "-7.829777, -34.909341"
        },
        {
            "QTD": 119,
            "SETOR": "SAÚDE",
            "PONTO": "FINANCEIRO DA SECRETARIA DE SAÚDE",
            "ENDEREÇO": "R. JOAQUIM NABUCO, 203 - CENTRO",
            "COORDENADAS": "-7.829777, -34.909341"
        },
        {
            "QTD": 120,
            "SETOR": "SAÚDE",
            "PONTO": "POLICLINICA SÃO LUCAS",
            "ENDEREÇO": "RUA AUGUSTO VAZ DE OLIVEIRA - CRUZ DE REBOUÇAS",
            "COORDENADAS": "-7.872171, -34.907010"
        },
        {
            "QTD": 121,
            "SETOR": "SAÚDE",
            "PONTO": "VIGILÂNCIA EM SAÚDE",
            "ENDEREÇO": "RUA VALDEMAR LUÍS DO NASCIMENTO- CAMPINA FEIRA",
            "COORDENADAS": "-7.820609, -34.913622"
        },
        {
            "QTD": 122,
            "SETOR": "SAÚDE",
            "PONTO": "CAF",
            "ENDEREÇO": "RUA PEDRO DE MELO COSTA, 90 - AGAMENON MAGALHÃES",
            "COORDENADAS": "-7.827704, -34.911627"
        },
        {
            "QTD": 123,
            "SETOR": "SAÚDE",
            "PONTO": "CAP. FELIPE (BONFIM 1)",
            "ENDEREÇO": "AV. RUBINA, 182-236 - SANTA LUZIA",
            "COORDENADAS": "-7.878523, -34.908895"
        },
        {
            "QTD": 124,
            "SETOR": "SAÚDE",
            "PONTO": "UNIDADE MISTA DE IGARASSU",
            "ENDEREÇO": "RUA DR. COSME DE SÁ PEREIRA, S/N - CENTRO",
            "COORDENADAS": "-7.831212, -34.911855"
        },
        {
            "QTD": 125,
            "SETOR": "SAÚDE",
            "PONTO": "SAMU",
            "ENDEREÇO": "AV. DUARTE COELHO, 563-843 - CAMPINA DE FEIRA",
            "COORDENADAS": "-7.822092, -34.913604"
        },
        {
            "QTD": 126,
            "SETOR": "SAÚDE",
            "PONTO": "CENTRO DE SAÚDE DA MULHER",
            "ENDEREÇO": "RUA ALFREDO VIEIRA DE MELO - CRUZ DE REBOUÇAS",
            "COORDENADAS": "-7.870927, -34.901876"
        },
        {
            "QTD": 127,
            "SETOR": "SAÚDE",
            "PONTO": "CLINICA DE OLHOS DE CRUZ DE REBOUÇAS",
            "ENDEREÇO": "BR-101, 820 - CRUZ DE REBOUÇAS",
            "COORDENADAS": "-7.873288, -34.906280"
        },
        {
            "QTD": 128,
            "SETOR": "SAÚDE",
            "PONTO": "LAME CRESP",
            "ENDEREÇO": "R. TEN. PEDRO GALÃO, 172 - CRUZ DE REBOUÇAS",
            "COORDENADAS": "-7.871393, -34.907601"
        },
        {
            "QTD": 129,
            "SETOR": "SAÚDE",
            "PONTO": "RESIDENCIAL SANTO ANTONIO",
            "ENDEREÇO": "AV. SEVERINO TAVARES UCHOA, CENTRO",
            "COORDENADAS": "-7.825455, -34.924387"
        },
        {
            "QTD": 130,
            "SETOR": "SAÚDE",
            "PONTO": "USF PITANGA",
            "ENDEREÇO": "MONJOPE, IGARASSU - PE",
            "COORDENADAS": "-7.856424, -34.983105"
        },
        {
            "QTD": 131,
            "SETOR": "SAÚDE",
            "PONTO": "USF BONFIM 1",
            "ENDEREÇO": "RUA AFRANIO – CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.879502, -34.910833"
        },
        {
            "QTD": 132,
            "SETOR": "SAÚDE",
            "PONTO": "USF BOA SORTE",
            "ENDEREÇO": "RUA MARIA DAS DORES – CRUZ DE REBOUCAS",
            "COORDENADAS": "-7.865751, -34.905636"
        },
        {
            "QTD": 133,
            "SETOR": "SAÚDE",
            "PONTO": "USF NOVA CRUZ 2",
            "ENDEREÇO": "NOVA CRUZ – NOVA CRUZ",
            "COORDENADAS": "-7.848340, -34.855161"
        },
        {
            "QTD": 134,
            "SETOR": "SAÚDE",
            "PONTO": "USF SANTA CRUZ 1",
            "ENDEREÇO": "RUA SÃO JOSÉ - CENTRO",
            "COORDENADAS": "-7.874182, -34.908201"
        },
        {
            "QTD": 135,
            "SETOR": "SAÚDE",
            "PONTO": "USF CUIEIRAS",
            "ENDEREÇO": "RUA SÃO JOÃO BATISTA -CUIEIRAS",
            "COORDENADAS": "-7.857492, -34.888986"
        },
        {
            "QTD": 136,
            "SETOR": "SAÚDE",
            "PONTO": "USF PIRAJUI",
            "ENDEREÇO": "SITIO ENGENHO NOVO E PIRAJUI – NOVA CRUZ II",
            "COORDENADAS": "-7.845288, -34.852910"
        },
        {
            "QTD": 137,
            "SETOR": "SAÚDE",
            "PONTO": "USF TABULEIRO",
            "ENDEREÇO": "GRANJA ARAGACA – TABULEIRO",
            "COORDENADAS": "-7.853994, -34.956442"
        },
        {
            "QTD": 138,
            "SETOR": "SAÚDE",
            "PONTO": "TRES LADEIRAS",
            "ENDEREÇO": "VILA TRES LADEIRAS – TRES LADEIRAS",
            "COORDENADAS": "-7.759220, -35.031127"
        },
        {
            "QTD": 139,
            "SETOR": "PREFEITURA",
            "PONTO": "SEC. DAS CIDADES",
            "ENDEREÇO": "R. SEVERINO UCHÔA CAVALCANTE, 151 - CENTRO",
            "COORDENADAS": "-7.831940,-34.908140"
        },
        {
            "QTD": 140,
            "SETOR": "PREFEITURA",
            "PONTO": "LOGISTICA E MANUTENÇÃO",
            "ENDEREÇO": "R. SEVERINO UCHÔA CAVALCANTE, 151 - CENTRO",
            "COORDENADAS": "-7.831940,-34.908140"
        }
    ];
    return markers;
}


function initialize() {	
	var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
	
    var options = {
        zoom: 5,
		center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // Load JSON Data
    hotelMarkers = getJSONMarkers();

    map = new google.maps.Map(document.getElementById("mapa"), options);
}

initialize();

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}

function carregarPontos() {
    //console.log("ddddd")
    jQuery.ajax({
        type: 'GET',
        url: '/mikrotik/activeDesactiveClients/',
        datatype: 'json'
    }).done(function (retorno) {
        //console.log(retorno)
        var latlngbounds = new google.maps.LatLngBounds();
        icon = '/img/conectado2.png'
        //console.log(hotelMarkers)

        //console.log(retorno.clientes)
        $.each(hotelMarkers, function(index, ponto) {

            var retorno = ponto.COORDENADAS.split(",");

            var latitude = retorno[0]
            var longitude = retorno[1]
            console.log(retorno[0])
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude, longitude),
                title: "Nome:" + ponto.nome   + "\nLogin:" + ponto.PONTO  + "\nEnd.::" + ponto.ENDEREÇO,
                icon: icon,
                map: map
            });

            //if(ponto.status == "desconectado"){
                //marker.setAnimation(google.maps.Animation.BOUNCE);
               // marker.labelContent = ponto.login;
            //}


            //var myOptions = {
                //content: "<p>" + "Nome:" + ponto.nome   + "<br>Login:" + ponto.login  + "<br>End.::" + ponto.Descricao + "<br>Tempo:" + ponto.uptime + "</p>",
                //pixelOffset: new google.maps.Size(-150, 0)
            //};

            //infoBox[ponto.Id] = new InfoBox(myOptions);
            //infoBox[ponto.Id].marker = marker;

            //infoBox[ponto.Id].listener = google.maps.event.addListener(marker, 'click', function (e) {
                //abrirInfoBox(ponto.Id, marker);
            //});

            markers.push(marker);

            latlngbounds.extend(marker.position);

        });

        //Agrupa os makers
        //var markerCluster = new MarkerClusterer(map, markers);

        map.fitBounds(latlngbounds);
    });
	
}

carregarPontos();