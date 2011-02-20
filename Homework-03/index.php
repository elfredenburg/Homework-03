<?php

/**
 * 
 * @author Elizabeth Fredenburg
 * @category Advanced PHP -- anm 293
 * 
 * 
 * Homework 03
 * 
 */

  date_default_timezone_set('America/Detroit');
  @ini_set('display_errors','Off');
  @ini_set('log_errors','On');
  @ini_set('max_execution_time', 200);
  error_reporting(E_ALL & ~E_STRICT);
  
  if( PATH_SEPARATOR  == ';' )
    define('SLASH','\\');
  else
    define('SLASH','/'); 

  define('APP_PATH', realpath(dirname(__FILE__)));
  define('CACHE_PATH',APP_PATH . SLASH . 'temp' . SLASH);
  
  set_include_path('.'.PATH_SEPARATOR.implode(PATH_SEPARATOR, array(
    realpath(APP_PATH . SLASH . 'library' . SLASH . 'Swift' . SLASH . '4.0.6' ))));
  
  require_once 'lib/swift_required.php';
  
    $transport = Swift_SmtpTransport::newInstance ('smtp.gmail.com', 465, 'ssl')
      ->setUsername('advphpacc')
      ->setPassword('CNManm293')
    ;

    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance()
      ->setFrom(array('advphpacc@gmail.com' => 'Elizabeth Fredenburg'))
      ->setTo(array('Bob.Fredenburg@thomsonreuters.com' => 'Bob'))
      ->setSubject('Elizabeth Fredenburg, SWIFT Mailer 4.0.6')
      ->setContentType('text/html')
      ->setBody('I rock at PHP', 'text/html')
      ->setReplyTo('advphpacc@gmail.com')
    ;

    $headers = $message -> getHeaders();
    $headers -> addTextHeader('ANM293', 'CNM-270');
  
  try {
    
    $result = $mailer -> send($message);

  } catch (Swift_TransportException $e){
    LOG_ERR;
  }
