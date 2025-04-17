<?php
    include "../../app/conection.php";
    session_start();

    if(isset($_POST['getVideos'])){
        $start = $conexao->real_escape_string($_POST['start']);
        $limit = $conexao->real_escape_string($_POST['limit']);
        
        $sql = "SELECT v.*, u.usuario, u.nome 
                FROM videos v 
                JOIN usuario u ON v.usuario_id = u.usuario_id 
                ORDER BY RAND() 
                LIMIT $start, $limit";
        
        $res = mysqli_query($conexao, $sql);
        
        if (!$res) {
            exit('erro: ' . mysqli_error($conexao));
        }
        
        if(mysqli_num_rows($res) > 0){
            $response ="";
            while($video = mysqli_fetch_assoc($res)) {
                if(isset($_SESSION['usuario'])){
                    $videoid = $video['id'];
                    $usuarioid = $_SESSION['usuario_id'];
                    
                    $q = mysqli_query($conexao, "SELECT id FROM likes WHERE usuario_id='$usuarioid' AND video_id='$videoid'");
                    
                    if (!$q) {
                        $class = "btn btn-outline-danger btn-lg";
                        $iclass = "far fa-heart";
                    } else if(mysqli_num_rows($q) == 0){
                        $class = "btn btn-outline-danger btn-lg";
                        $iclass = "far fa-heart";
                    } else {
                        $class = "btn btn-danger btn-lg";
                        $iclass = "fas fa-heart";
                    }
                }
                
                $data_formatada = date('d/m/Y', strtotime($video['data_upload']));

                if(isset($_SESSION['adm'])){
                $response .='
                    <div class="shadow-none p-3 mb-5 bg-custom rounded">
                        <form method="POST" action="restrict/admin"><button type="submit" name="deletar-video" class="btn btn-outline-light btn-md"><i class="fas fa-trash"></i></button>
                            <input type="hidden" value="'.$video['usuario'].'" name="usuarioNome">
                            <input type="hidden" value="'.$video['id'].'" name="videoId">
                            <input type="hidden" value="'.$video['titulo'].'" name="videoTitulo">
                        </form>
                        <h3 class="text-center video-title">
                            '.$video['titulo'].'
                        </h3>
                        <div class="row">
                            <iframe width="100%" height="600px" class="rounded" 
                                src="'.$video['video_url'].'"
                                title="Player do YouTube" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                            <p class="video-data2 video-data">
                                '.$video['descricao'].'
                            </p>
                            <div class="video-data">
                                <form method="GET" action="category"><p>Categoria: </p><button type="submit" class="btn btn-outline-light btn-md">'.$video['categoria'].'</button>
                                    <input type="hidden" value="'.$video['categoria'].'" name="customCategory"><br>
                                </form>
                            </div>
                            <div class="video-data userPosted video-data-color">
                                <form method="GET" action="user"><p>Usuário: </p><button type="submit" class="btn btn-outline-light btn-md">@'.$video['usuario'].'</button>
                                    <input type="hidden" value="'.$video['usuario'].'" name="userProfile"><br>
                                </form>
                            </div>
                            <div class="video-data">
                                <p> 
                                    Postado em '.$data_formatada.'
                                </p>
                            </div>
                            <form method="POST" action="restrict/like.php">
                                <h3 class="video-data like-button">
                                    <input type="hidden" value="'.$video['id'].'" name="postid">
                                    <input type="hidden" value="index" name="headerlocal">
                                    <button class="'.$class.'" name="like-video" type="submit"><i class="'.$iclass.'"></i></button>
                                </h3>
                            </form>
                        </div>
                    </div>';
                } else if((isset($_SESSION['usuario']))){
                    $response .='
                    <div class="shadow-none p-3 mb-5 bg-custom rounded">
                        <h3 class="text-center video-title">
                            '.$video['titulo'].'
                        </h3>
                        <div class="row">
                            <iframe width="100%" height="600px" class="rounded" 
                                src="'.$video['video_url'].'"
                                title="Player do YouTube" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                            <p class="video-data2 video-data">
                                '.$video['descricao'].'
                            </p>
                            <div class="video-data">
                                <form method="GET" action="category"><p>Categoria: </p><button type="submit" class="btn btn-outline-light btn-md">'.$video['categoria'].'</button>
                                    <input type="hidden" value="'.$video['categoria'].'" name="customCategory"><br>
                                </form>
                            </div>
                            <div class="video-data userPosted video-data-color">
                                <form method="GET" action="user"><p>Usuário: </p><button type="submit" class="btn btn-outline-light btn-md">@'.$video['usuario'].'</button>
                                    <input type="hidden" value="'.$video['usuario'].'" name="userProfile"><br>
                                </form>
                            </div>
                            <div class="video-data">
                                <p> 
                                    Postado em '.$data_formatada.'
                                </p>
                            </div>
                            <form method="POST" action="restrict/like.php">
                                <h3 class="video-data like-button">
                                    <input type="hidden" value="index" name="headerlocal">
                                    <input type="hidden" value="'.$video['id'].'" name="postid">
                                    <button class="'.$class.'" name="like-video" type="submit"><i class="'.$iclass.'"></i></button>
                                </h3>
                            </form>
                        </div>
                    </div>';
                } else {
                    $response .='
                    <div class="shadow-none p-3 mb-5 bg-custom rounded">
                        <h3 class="text-center video-title">
                            '.$video['titulo'].'
                        </h3>
                        <div class="row">
                            <iframe width="100%" height="600px" class="rounded" 
                                src="'.$video['video_url'].'"
                                title="Player do YouTube" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                            <p class="video-data2 video-data">
                                '.$video['descricao'].'
                            </p>
                            <div class="video-data">
                                <form method="GET" action="category"><p>Categoria: </p><button type="submit" class="btn btn-outline-light btn-md">'.$video['categoria'].'</button>
                                    <input type="hidden" value="'.$video['categoria'].'" name="customCategory"><br>
                                </form>
                            </div>
                            <div class="video-data userPosted video-data-color">
                                <form method="GET" action="user"><p>Usuário: </p><button type="submit" class="btn btn-outline-light btn-md">@'.$video['usuario'].'</button>
                                    <input type="hidden" value="'.$video['usuario'].'" name="userProfile"><br>
                                </form>
                            </div>
                            <div class="video-data">
                                <p> 
                                    Postado em '.$data_formatada.'
                                </p>
                            </div>
                            <h3 class="video-data like-button">
                                    <button class="btn btn-outline-danger btn-sm" type="submit" disabled><i class="far fa-heart"></i> Logue para curtir.</button>
                            </h3>
                        </div>
                    </div>';
                }
            }
            exit($response);
        } else
            exit('reachedMax');
    }
?>