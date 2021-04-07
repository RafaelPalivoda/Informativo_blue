<?php

namespace App;

use Spatie\Browsershot\Browsershot;


class PDFPageGenerator
{
    //const NODE_BINARY_PATH = '/home/evandro/.nvm/versions/node/v12.16.3/bin/node';
    //const NPM_BINARY_PATH = '/home/evandro/.nvm/versions/node/v12.16.3/bin/npm';

    const NODE_BINARY_PATH = '/home/hqs/.nvm/versions/node/v10.13.0/bin/node';
    const NPM_BINARY_PATH = '/usr/bin/npm';


    public function generate( $contents, $filename  )
    {
        Browsershot::html( $contents )
            ->margins(0,0, 15,0 )
            ->showBrowserHeaderAndFooter()
            ->showBackground()
            ->noSandbox()
            ->fullPage()
            ->headerHtml('')
            ->footerHtml( $this->getFooter2() )
            ->setNodeBinary( self::NODE_BINARY_PATH )
            ->setNpmBinary(self::NPM_BINARY_PATH )
            ->save($filename);

    }

    public function generateHtml( $subtitulo, $texto, $template )
    {
        $contents = file_get_contents($template);
        $contents = str_replace('{{__SUB_TITULO__}}', $subtitulo, $contents );
        $contents = str_replace('{{__TEXTO__}}', $texto, $contents );

        return $contents;
    }

    public function getFooterHtml()
    {
        return "";
    }

    public function getFooter2()
    {
        return file_get_contents('../html/footer.html');
    }
}