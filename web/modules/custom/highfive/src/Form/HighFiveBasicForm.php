<?php

namespace Drupal\highfive\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the HighFiveForm form controller.
 */
class HighFiveBasicForm extends FormBase {

  /**
   * Build the highfive form.
   *
   * A build form method constructs an array that defines how markup and
   * other form elements are included in an HTML form.
   *
   * @param array $form
   *   Default form array structure.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object containing current form state.
   *
   * @return array
   *   The render array defining the elements of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Email.
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => 'Email, user@domain.com',
      '#required' => TRUE,
    ];

    // Date.
    $form['dob'] = [
      '#type' => 'date',
      '#title' => $this->t('Date of Birth'),
      '#default_value' => ['year' => 2020, 'month' => 2, 'day' => 15],
      '#description' => 'Date, mm/dd/yyyy',
      '#required' => TRUE,
    ];

    // Checkbox
    $form['icecream_flavor'] = [
      '#type' => 'checkboxes',
      '#options' => ['Chocolate' => t('Chocolate'), 'Vanilla' => t('Vanilla'), 'Strawberry' => t('Strawberry')],
      '#title' => $this->t('What is your favorite flavor of ice cream?'),
      '#description' => 'Checkboxes, Choose only one.',
      '#required' => TRUE,
    ];

    // Tel.
    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Contact Phone Number'),
      '#description' => $this->t('Tel, xxx-xxx-xxxx'),
      '#required' => TRUE,
    ];

    // Textfield.
    $form['game'] = [
      '#type' => 'textfield',
      '#title' => t('What is your favorite game?'),
      '#size' => 60,
      '#maxlength' => 128,
      '#description' => $this->t('Textfield, Please enter your game\'s name.'),
      '#required' => TRUE,
    ];

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form. This is not required, but is convention.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * Getter method for Form ID.
   *
   * The form ID is used in implementations of hook_form_alter() to allow other
   * modules to alter the render array built by this form controller.  it must
   * be unique site wide. It normally starts with the providing module's name.
   *
   * @return string
   *   The unique ID of the form defined by this class.
   */
  public function getFormId() {
    return 'highfive_basic_form';
  }

  /**
   * Implements form validation.
   *
   * The validateForm method is the default method called to validate input on
   * a form.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    if ($email == "zelda@freemoney.com") {
      // Set an error for the form element with a key of "title".
      $form_state->setErrorByName('email', $this->t('zelda@freemoney.com cannot submit this form.'));
    }
    $favorites = 0;
    foreach ($form_state->getValue('icecream_flavor') as $key => $value){
      if ($value){
        $favorites++;
        if ($favorites > 1) {
          $form_state->setErrorByName('icecream_flavor', $this->t('You really can only have one *favorite*. Please select only one.'));
        }
        if ($key != 'Chocolate') {
          $form_state->setErrorByName('icecream_flavor', $this->t('It appears you have mis-clicked. Please correctly select Chocolate as your favorite ice cream.'));
        }
      }
    }
  }

  /**
   * Implements a form submit handler.
   *
   * The submitForm method is the default method called for any submit elements.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message(t('Thank you for submitting this awesome form!'));
  }

}
