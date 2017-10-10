<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');


if (isset($_SESSION) && $_SESSION['language'] == 'fr') {
    $lang['form_validation_required']              = "Le champ {field} est requis.";
    $lang['form_validation_isset']                 = "Le champ {field} doit avoir une valeur.";
    $lang['form_validation_valid_email']           = "Le champ {field} doit contenir une adresse email valide.";
    $lang['form_validation_valid_emails']          = "Le champ {field} ne peut contenir que des adresses email valides.";
    $lang['form_validation_valid_url']             = "Le champ {field} doit contenir une URL valide.";
    $lang['form_validation_valid_ip']              = "Le champ {field} doit contenir une IP valide.";
    $lang['form_validation_min_length']            = "Le champ {field} doit contenir au moins {param} caractères.";
    $lang['form_validation_max_length']            = "Le champ {field} ne peut contenir plus de {param} caractères.";
    $lang['form_validation_exact_length']          = "Le champ {field} doit contenir exactement {param} caractères.";
    $lang['form_validation_alpha']                 = "Le champ {field} ne peut contenir que des caractères alphabétiques.";
    $lang['form_validation_alpha_numeric']         = "Le champ {field} ne peut contenir que des caractères alphanumériques.";
    $lang['form_validation_alpha_numeric_spaces']  = "Le champ {field} ne peut contenir que des caractères alphanumériques et des espaces.";
    $lang['form_validation_alpha_dash']            = "Le champ {field} ne peut contenir que des caractères alphanumériques, des caractères de soulignement et des traits d'union.";
    $lang['form_validation_numeric']               = "Le champ {field} doit contenir un nombre (caractères numériques).";
    $lang['form_validation_is_numeric']            = "Le champ {field} ne peut contenir que de signes du type nombre.";
    $lang['form_validation_integer']               = "Le champ {field} doit contenir un nombre entier.";
    $lang['form_validation_regex_match']           = "Le champ {field} n'utilise pas le bon format.";
    $lang['form_validation_matches']               = "Le champ {field} doit correspondre au champ {param}.";
    $lang['form_validation_differs']               = "Le champ {field} doit être différent du champ {param}.";
    $lang['form_validation_is_unique']             = "Le champ {field} doit contenir une valeur unique.";
    $lang['form_validation_is_natural']            = "Le champ {field} ne peut contenir que des nombres positifs.";
    $lang['form_validation_is_natural_no_zero']    = "Le champ {field} ne peut contenir que des nombres plus grands que zéro.";
    $lang['form_validation_decimal']               = "Le champ {field} doit contenir un nombre décimal.";
    $lang['form_validation_less_than']             = "Le champ {field} doit contenir un nombre inférieur à {param}.";
    $lang['form_validation_less_than_equal_to']    = "Le champ {field} doit contenir un nombre inférieur ou égal à {param}.";
    $lang['form_validation_greater_than']          = "Le champ {field} doit contenir un nombre supérieur à {param}.";
    $lang['form_validation_greater_than_equal_to'] = "Le champ {field} doit contenir un nombre supérieur ou égal à {param}.";
    $lang['form_validation_error_message_not_set'] = "Impossible d'accéder à un message d'erreur correspondant à votre champ nommé {field}.";
    $lang['form_validation_in_list']               = "Le champ {field} doit avoir une de ces valeurs : {param}.";
    return;
}

$lang['form_validation_required']		= 'The {field} field is required.';
$lang['form_validation_isset']			= 'The {field} field must have a value.';
$lang['form_validation_valid_email']		= 'The {field} field must contain a valid email address.';
$lang['form_validation_valid_emails']		= 'The {field} field must contain all valid email addresses.';
$lang['form_validation_valid_url']		= 'The {field} field must contain a valid URL.';
$lang['form_validation_valid_ip']		= 'The {field} field must contain a valid IP.';
$lang['form_validation_min_length']		= 'The {field} field must be at least {param} characters in length.';
$lang['form_validation_max_length']		= 'The {field} field cannot exceed {param} characters in length.';
$lang['form_validation_exact_length']		= 'The {field} field must be exactly {param} characters in length.';
$lang['form_validation_alpha']			= 'The {field} field may only contain alphabetical characters.';
$lang['form_validation_alpha_numeric']		= 'The {field} field may only contain alpha-numeric characters.';
$lang['form_validation_alpha_numeric_spaces']	= 'The {field} field may only contain alpha-numeric characters and spaces.';
$lang['form_validation_alpha_dash']		= 'The {field} field may only contain alpha-numeric characters, underscores, and dashes.';
$lang['form_validation_numeric']		= 'The {field} field must contain only numbers.';
$lang['form_validation_is_numeric']		= 'The {field} field must contain only numeric characters.';
$lang['form_validation_integer']		= 'The {field} field must contain an integer.';
$lang['form_validation_regex_match']		= 'The {field} field is not in the correct format.';
$lang['form_validation_matches']		= 'The {field} field does not match the {param} field.';
$lang['form_validation_differs']		= 'The {field} field must differ from the {param} field.';
$lang['form_validation_is_unique'] 		= 'The {field} field must contain a unique value.';
$lang['form_validation_is_natural']		= 'The {field} field must only contain digits.';
$lang['form_validation_is_natural_no_zero']	= 'The {field} field must only contain digits and must be greater than zero.';
$lang['form_validation_decimal']		= 'The {field} field must contain a decimal number.';
$lang['form_validation_less_than']		= 'The {field} field must contain a number less than {param}.';
$lang['form_validation_less_than_equal_to']	= 'The {field} field must contain a number less than or equal to {param}.';
$lang['form_validation_greater_than']		= 'The {field} field must contain a number greater than {param}.';
$lang['form_validation_greater_than_equal_to']	= 'The {field} field must contain a number greater than or equal to {param}.';
$lang['form_validation_error_message_not_set']	= 'Unable to access an error message corresponding to your field name {field}.';
$lang['form_validation_in_list']		= 'The {field} field must be one of: {param}.';
