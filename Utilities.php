<?php


class Utilities {

   public static function POST_redirect($url) {
        header("Location: ".htmlspecialchars_decode($url), true, 303);
        die;
    }

    public static function VerifierAdresseMail($adresse){
        //Adresse mail trop longue (254 octets max)
        if (strlen($adresse) > 254) {
            return '0';
        }

        //Caractères non-ASCII autorisés dans un nom de domaine .eu :

        $nonASCII = 'ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
        $nonASCII .= 'ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
        $nonASCII .= 'ũūŭůűųŵŷźżztșțΐάέήίΰαβγδεζηθικλμνξοπρςστυφ';
        $nonASCII .= 'χψωϊϋόύώабвгдежзийклмнопрстуфхцчшщъыьэюяt';
        $nonASCII .= 'ἀἁἂἃἄἅἆἇἐἑἒἓἔἕἠἡἢἣἤἥἦἧἰἱἲἳἴἵἶἷὀὁὂὃὄὅὐὑὒὓὔ';
        $nonASCII .= 'ὕὖὗὠὡὢὣὤὥὦὧὰάὲέὴήὶίὸόὺύὼώᾀᾁᾂᾃᾄᾅᾆᾇᾐᾑᾒᾓᾔᾕᾖᾗ';
        $nonASCII .= 'ᾠᾡᾢᾣᾤᾥᾦᾧᾰᾱᾲᾳᾴᾶᾷῂῃῄῆῇῐῑῒΐῖῗῠῡῢΰῤῥῦῧῲῳῴῶῷ';
        // note : 1 caractète non-ASCII vos 2 octets en UTF-8

        $syntaxe = "#^[[:alnum:][:punct:]]{1,64}@[[:alnum:]-.$nonASCII]{2,253}\.[[:alpha:].]{2,6}$#";

        if (preg_match($syntaxe, $adresse)) {
            //C'est bon
            return '1';
        } else {
            return '2';
        }
    }


}


