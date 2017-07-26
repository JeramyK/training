<?php
/**
  * @file
  * Contains \Drupal\rsvplist\Form\RsvpForm
  */
namespace Drupal\rsvplist\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Provides and RSVP Email Form
*/
class RsvpForm extends FormBase
{
  /**
    * (@inheritdoc)
    */
  public function getFormId() {
    return 'rsvplist_email_form';
  }
  /**
    * (@inheritdoc)
    */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->nid->value;
    $form['email'] = array(
      '#title' => t('Email Address'),
      '#type' => 'textfield',
      '#size' => 25,
      '#description' => ("We'll send updates to the email address you provide."),
      '#required' => TRUE,
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('RSVP'),
    );
    $form['nid'] = array(
      '#type' => 'hidden',
      '#value' => $nid,
    );
    dpm($form);
    return $form;
  }
  /**
    * (@inheritdoc)
    */
  public function validateForm(array &$form, FormStateInterface $form_state){
    $value = $form_state->getValue('email');
    if($value == !\Drupal::service('email.validator')->isValid($value)) {
      $errText = 'The email address '.$value.' is not valid.';
      $form_state->setErrorByName ('email', t('The email address %mail is not valid.', array('%mail' => $value)));
      \Drupal::logger('RsvpForm')->error($errText);
    }
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message(t('The form is working.'));
  }
}
