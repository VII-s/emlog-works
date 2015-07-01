/**
 * Copyright since 2015, Mike Tang.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *  1. Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *  2. Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *  3. Neither the name of Lloyd Hilaiel nor the names of its
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR AS IS'' AND ANY EXPRESS OR
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT,
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
 * HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
 * STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING
 * IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

function getGithubDocByUrl() {
    var URL = document.getElementById("githuburl").value;
    console.log(URL);
    console.log(BASE64.encoder(URL));
    getLabelsGet(BASE64.encoder(URL));
}

// ===============
var xmlHttp;
var isSend = false;
function GetXmlHttpObject(){
    if (window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlhttp;
}

function getLabelsGet(URL){
    document.getElementById('githubdoc').text = '正在发送中....';
    document.getElementById('githubdoc').disabled = true;
    if (isSend) {
        alert("已经发送过，请稍后再试！！！");
        return;
    }
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null){
        alert('您的浏览器不支持AJAX！');
        return;
    }
    isSend = true;
    var url = "/?plugin=githubsync&github-url=" + URL;
    xmlHttp.open("GET", url, true);
    xmlHttp.onreadystatechange = getOkGet;//发送事件后，收到信息了调用函数
    xmlHttp.onError = getError;
    xmlHttp.send();
}

function getError(){
    isSend = false;
    alert("访问失败!");
    document.getElementById('githubdoc').text = '失败，再试一次？';
    document.getElementById('githubdoc').disabled = false;
}

function getOkGet(){
    if (xmlHttp.readyState == 4 && xmlHttp.status==200){
        try {
            var docinfo = eval(xmlHttp.responseText);
            document.getElementById('title').value = UrlDecode(docinfo[0]);
            KindEditor.appendHtml('#content', UrlDecode(docinfo[1]));
            alert(UrlDecode(docinfo[0]) + "已经同步完成");
            isSend = false;
            document.getElementById('githubdoc').text = '已完成！享受吧少年!';
            document.getElementById('githubdoc').disabled = false;
        } catch (e) {
            console.log(e.toString());
            getError();
        }
    }
}
function UrlDecode(zipStr){
    var uzipStr="";
    for(var i=0; i < zipStr.length; i++){
        var chr = zipStr.charAt(i);
        if(chr == "+"){
            uzipStr += " ";
        } else if (chr == "%") {
            var asc = zipStr.substring(i+1,i+3);
            if(parseInt("0x"+asc) > 0x7f) {
                uzipStr += decodeURI("%"+asc.toString()+zipStr.substring(i+3,i+9).toString());
                i += 8;
            } else {
                uzipStr += AsciiToString(parseInt("0x"+asc));
                i += 2;
            }
        } else {
            uzipStr+= chr;
        }
    }

    return uzipStr;
}

function StringToAscii(str) {
    return str.charCodeAt(0).toString(16);
}
function AsciiToString(asccode) {
    return String.fromCharCode(asccode);
}


/**
 *create by 2012-08-25 pm 17:48
 *@author hexinglun@gmail.com
 *BASE64 Encode and Decode By UTF-8 unicode
 *可以和java的BASE64编码和解码互相转化
 */
(function(){
    var BASE64_MAPPING = [
        'A','B','C','D','E','F','G','H',
        'I','J','K','L','M','N','O','P',
        'Q','R','S','T','U','V','W','X',
        'Y','Z','a','b','c','d','e','f',
        'g','h','i','j','k','l','m','n',
        'o','p','q','r','s','t','u','v',
        'w','x','y','z','0','1','2','3',
        '4','5','6','7','8','9','+','/'
    ];

    /**
     *ascii convert to binary
     */
    var _toBinary = function(ascii){
        var binary = new Array();
        while(ascii > 0){
            var b = ascii%2;
            ascii = Math.floor(ascii/2);
            binary.push(b);
        }
        /*
           var len = binary.length;
           if(6-len > 0){
           for(var i = 6-len ; i > 0 ; --i){
           binary.push(0);
           }
           }*/
        binary.reverse();
        return binary;
    };

    /**
     *binary convert to decimal
     */
    var _toDecimal  = function(binary){
        var dec = 0;
        var p = 0;
        for(var i = binary.length-1 ; i >= 0 ; --i){
            var b = binary[i];
            if(b == 1){
                dec += Math.pow(2 , p);
            }
            ++p;
        }
        return dec;
    };

    /**
     *unicode convert to utf-8
     */
    var _toUTF8Binary = function(c , binaryArray){
        var mustLen = (8-(c+1)) + ((c-1)*6);
        var fatLen = binaryArray.length;
        var diff = mustLen - fatLen;
        while(--diff >= 0){
            binaryArray.unshift(0);
        }
        var binary = [];
        var _c = c;
        while(--_c >= 0){
            binary.push(1);
        }
        binary.push(0);
        var i = 0 , len = 8 - (c+1);
        for(; i < len ; ++i){
            binary.push(binaryArray[i]);
        }

        for(var j = 0 ; j < c-1 ; ++j){
            binary.push(1);
            binary.push(0);
            var sum = 6;
            while(--sum >= 0){
                binary.push(binaryArray[i++]);
            }
        }
        return binary;
    };

    var __BASE64 = {
        /**
         *BASE64 Encode
         */
        encoder:function(str){
            var base64_Index = [];
            var binaryArray = [];
            for(var i = 0 , len = str.length ; i < len ; ++i){
                var unicode = str.charCodeAt(i);
                var _tmpBinary = _toBinary(unicode);
                if(unicode < 0x80){
                    var _tmpdiff = 8 - _tmpBinary.length;
                    while(--_tmpdiff >= 0){
                        _tmpBinary.unshift(0);
                    }
                    binaryArray = binaryArray.concat(_tmpBinary);
                }else if(unicode >= 0x80 && unicode <= 0x7FF){
                    binaryArray = binaryArray.concat(_toUTF8Binary(2 , _tmpBinary));
                }else if(unicode >= 0x800 && unicode <= 0xFFFF){//UTF-8 3byte
                    binaryArray = binaryArray.concat(_toUTF8Binary(3 , _tmpBinary));
                }else if(unicode >= 0x10000 && unicode <= 0x1FFFFF){//UTF-8 4byte
                    binaryArray = binaryArray.concat(_toUTF8Binary(4 , _tmpBinary));
                }else if(unicode >= 0x200000 && unicode <= 0x3FFFFFF){//UTF-8 5byte
                    binaryArray = binaryArray.concat(_toUTF8Binary(5 , _tmpBinary));
                }else if(unicode >= 4000000 && unicode <= 0x7FFFFFFF){//UTF-8 6byte
                    binaryArray = binaryArray.concat(_toUTF8Binary(6 , _tmpBinary));
                }
            }

            var extra_Zero_Count = 0;
            for(var i = 0 , len = binaryArray.length ; i < len ; i+=6){
                var diff = (i+6)-len;
                if(diff == 2){
                    extra_Zero_Count = 2;
                }else if(diff == 4){
                    extra_Zero_Count = 4;
                }
                //if(extra_Zero_Count > 0){
                //	len += extra_Zero_Count+1;
                //}
                var _tmpExtra_Zero_Count = extra_Zero_Count;
                while(--_tmpExtra_Zero_Count >= 0){
                    binaryArray.push(0);
                }
                base64_Index.push(_toDecimal(binaryArray.slice(i , i+6)));
            }

            var base64 = '';
            for(var i = 0 , len = base64_Index.length ; i < len ; ++i){
                base64 += BASE64_MAPPING[base64_Index[i]];
            }

            for(var i = 0 , len = extra_Zero_Count/2 ; i < len ; ++i){
                base64 += '=';
            }
            return base64;
        },
        /**
         *BASE64  Decode for UTF-8
         */
        decoder : function(_base64Str){
            var _len = _base64Str.length;
            var extra_Zero_Count = 0;
            /**
             *计算在进行BASE64编码的时候，补了几个0
             */
            if(_base64Str.charAt(_len-1) == '='){
                //alert(_base64Str.charAt(_len-1));
                //alert(_base64Str.charAt(_len-2));
                if(_base64Str.charAt(_len-2) == '='){//两个等号说明补了4个0
                    extra_Zero_Count = 4;
                    _base64Str = _base64Str.substring(0 , _len-2);
                }else{//一个等号说明补了2个0
                    extra_Zero_Count = 2;
                    _base64Str = _base64Str.substring(0 , _len - 1);
                }
            }

            var binaryArray = [];
            for(var i = 0 , len = _base64Str.length; i < len ; ++i){
                var c = _base64Str.charAt(i);
                for(var j = 0 , size = BASE64_MAPPING.length ; j < size ; ++j){
                    if(c == BASE64_MAPPING[j]){
                        var _tmp = _toBinary(j);
                        /*不足6位的补0*/
                        var _tmpLen = _tmp.length;
                        if(6-_tmpLen > 0){
                            for(var k = 6-_tmpLen ; k > 0 ; --k){
                                _tmp.unshift(0);
                            }
                        }
                        binaryArray = binaryArray.concat(_tmp);
                        break;
                    }
                }
            }

            if(extra_Zero_Count > 0){
                binaryArray = binaryArray.slice(0 , binaryArray.length - extra_Zero_Count);
            }

            var unicode = [];
            var unicodeBinary = [];
            for(var i = 0 , len = binaryArray.length ; i < len ; ){
                if(binaryArray[i] == 0){
                    unicode=unicode.concat(_toDecimal(binaryArray.slice(i,i+8)));
                    i += 8;
                }else{
                    var sum = 0;
                    while(i < len){
                        if(binaryArray[i] == 1){
                            ++sum;
                        }else{
                            break;
                        }
                        ++i;
                    }
                    unicodeBinary = unicodeBinary.concat(binaryArray.slice(i+1 , i+8-sum));
                    i += 8 - sum;
                    while(sum > 1){
                        unicodeBinary = unicodeBinary.concat(binaryArray.slice(i+2 , i+8));
                        i += 8;
                        --sum;
                    }
                    unicode = unicode.concat(_toDecimal(unicodeBinary));
                    unicodeBinary = [];
                }
            }
            return unicode;
        }
    };

    window.BASE64 = __BASE64;
})();
