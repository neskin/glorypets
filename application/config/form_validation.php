<?php
$config = array(
                 'signup' => array(
                                    array(
                                            'field' => 'user_login',
                                            'label' => 'Login',
                                            'rules' => 'trim|required|min_length[3]|xss_clean'
                                         ),
                                    array(
                                            'field' => 'user_password',
                                            'label' => 'Password',
                                            'rules' => 'trim|required|min_length[3]'
                                         ),
                                    array(
                                            'field' => 'user_email',
                                            'label' => 'E-mail',
                                            'rules' => 'trim|required|valid_email'
                                         )
                                    )                          
               );