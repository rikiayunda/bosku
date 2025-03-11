<h1>iNI HALAMAN HOME</h1>
<h1> <?php if (session()->get('level') == 1) {
                                                                            echo 'Admin';
                                                                        } else if (session()->get('level') == 2) {
                                                                            echo 'User';
                                                                        } else {
                                                                            echo ' Pelanggan ';
                                                                        } ?></h1>