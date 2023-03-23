/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function processaAjax() {
    this.LOADED = [];
}

processaAjax.prototype = {
    LOADED: [],
    /**
     *Verifica se na string existe comando em JavaScript a serem
     *executados
     *@param txt string a ser verificado
     **/
    recuperaScript: function (txt) {
        var onlyscr = "";
        while (txt !== "") {
            /*pegar a posição de inicio do javascript*/
            var pos = txt.search(/<script/i);
            if (pos === -1) {
                txt = "";
            } else {
                /*pegar a posição de final do javascript*/
                var fim = txt.search(/<\/script/i);
                onlyscr += txt.substring(pos, fim + 9);
                txt = txt.substr(fim + 9);
            }
        }
        ;
        return onlyscr;
    },
    LoadXMLString: function (txt) {/* carregar xml */
        txt = '<XML>' +
                this.recuperaScript(txt.replace(/&/gi, '&amp;')) +
                '</XML>';
        try {
            //IE
            xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
            xmlDoc.async = "false";
            xmlDoc.loadXML(txt);
            return(xmlDoc);
        } catch (e) {
            try {
                parser = new DOMParser();
                xmlDoc = parser.parseFromString(txt, "text/xml");
                return(xmlDoc);
            } catch (e) {
                alert(e.message);
            }
        }
        ;
        return(null);
    },
    processaJS: function (html) {/*executar javascript*/
        var xml = this.LoadXMLString(html);
        var scr = xml.getElementsByTagName('script');

        for (i = 0; i < scr.length; i++) {
            var node = scr[i];
            if (node.hasChildNodes()) {
                var txt = node.childNodes[0].data;
                if (txt !== null && txt !== "") {
                    var att = node.getAttribute('id');
                    var id = (att !== null ? att.nodeValue : null);
                    var ex = false;
                    if (id !== null) {
                        for (var k = 0; k < this.LOADED.length; k++) {
                            if (this.LOADED[k] === id) {
                                ex = true;
                                break;
                            }
                        }
                    }
                    if (ex === false) {
                        if (id !== null) {
                            this.LOADED[this.LOADED.length] = id;
                        }
                        ;
                        var nscr = document.createElement('script');
                        nscr.type = 'text/javascript';
                        nscr.language = 'javascript';

                        //dividir o texto em trez partes 1 inicio; 2 troca # por <br>; 3 final

                        if (txt.indexOf('//inicio') > 0) {
                            txtA = txt.substring(1, txt.indexOf('//inicio'));
                            txtB = txt.substring(txt.indexOf('//inicio'), txt.indexOf('//fim'));
                            txtB = txtB.replace(/#/g, '<br>');
                            txtC = txt.substring(txt.indexOf('//fim'), txt.length);

                            nscr.text = txtA + txtB + txtC;
                        } else {
                            nscr.text = txt;
                        }

                        document.body.appendChild(nscr);
                    }
                }
            }
        }
    }, run: function (url, div) {
        /*executar o ajax */
        var duashorasantes = new Date();
        duashorasantes.setHours(duashorasantes.getHours() - 2);
        if (url.indexOf('?') > 0) {
            url += '&t=' + duashorasantes;
        }
        var ax = new AJAX();
        ax.url = url;
        ax.div = div;
        ax.obj = this;

        ax.processaresultado = function (html) {
          
            var div = document.getElementById(this.div);
            div.innerHTML = html;
            this.obj.processaJS(html);
        };
        ax.conectar();
    }, runPost: function (url, div = null, formId, func = null) {
        /*inicio*/
//ERROR:  invalid input syntax for integer: 
//ERROR:  null value in column "nome" violates not-null constraint DETAIL:  Failing row contains (13785, null, null, -15.7617, -48.2816, null, null, 5200258, null, null, null, null, null, null, null, null
//ERROR:  duplicate key value violates unique constraint "restriaogeral" DETAIL:  Key (nome, lat, log)=(Nome da Propriedade, -15.7617, -48.2816) already exists.
        var form = document.getElementById(formId);

        if (div !== null) {
            var div = document.getElementById(div);
        }
        var ax = new AJAX();
        ax.url = url.trim();
        ax.metodo = form.method;
        ax.params = new FormData(form);
        ax.obj = this;

        var ret = '';

        ax.processaresultado = function (html) {
            
            if (html.substring(0, 28) === 'ERROR:  invalid input syntax') {
                ret = "Erro de preenchimento, Verifique os dados informados...";
            } else if (html.substring(0, 29) === 'ERROR:  null value in column ') {
                campo = html.substring(30, html.lastIndexOf('"'));
                ret = "O Campo [" + campo + "] deve ser informado...";
            } else if (html.substring(0, 27) === 'ERROR:  duplicate key value') {
                campo = html.substring(html.lastIndexOf('DETAIL:  Key') + 12, html.lastIndexOf('already exis') - 1);
                ret = "Os dados" + campo + " já foram cadastrados e não podem ser repetidos,\npor favor verifique os dados informados.";
            } else if (html.substring(0, 18) === 'Registro Alterado:') {
                ret = "Registro alterado com Sucesso!";
            } else if (html.substring(0, 32) === 'ERROR: insert or update on table') {
                campo = html.substring(html.lastIndexOf('DETAIL:  Key') + 12, html.lastIndexOf('table') - 1);
                ret = "Violação de Integridade:" + campo + "\nVerifique os dados informads!";
            } else {
                ret = html;
            }

            if (func !== null) {
                execFunc(func, ret);
            }

        };
        ax.conectar();

    }, runGet: function (url, div = null) {

        if (div !== null) {
            var div = document.getElementById(div);
        }
        var ax = new AJAX();
        ax.url = url;

        ax.obj = this;
        ax.processaresultado = function (html) {
            txt = ax.obj.recuperaScript(html);
            ax.obj.processaJS(txt);
            if (div !== null)
                div.innerHTML = html;
        };
        ax.conectar();

        return false;
    }, runJs: function (url) {

        var ax = new AJAX();
        ax.url = url;
        ax.obj = this;
        ax.asinc = false;
        ax.processaresultado = function (html) {
            this.obj.processaJS(html);
        };
        ax.conectar();
        /*fim*/
    },
    pegaJSON(url) {
        var ax = new AJAX();
        ax.url = url;
        ax.obj = this;
        ax.asinc = false;
        ax.processaresultado = function (html) {
            return html;
        };
        ax.conectar()
    }
};

function submitAjax() {
    this.LOADED = [];
}

var ObjProcAjax = new processaAjax();