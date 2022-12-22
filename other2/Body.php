t:30px;">
                            <p style="margin: 0; color:Black; margin-left:2px;">
                                <?php echo $p['Nom'];?>
                            </p>
                        </div>
                        <div class="date-heure-pub">
                            <p style="margin: 0; color:grey; margin-left:2px;">
                                <?php echo $p['DateHeurePublication']; ?>
                            </p>
                        </div>
                    </div>

                </div>
                <a href="one_pub.php?id=<?php echo $p['idPublication'] ?>" class="self-link">
                    <div class="texte">
                        <p style="margin: 0;">
                            <?php echo $p['TextePublication'] ?>
                        </p>
                    </div>
                </a>
                <?php echo $p['IReaction'];?> reaction(s)
                <div class="peopl_act">
                        <div class="like">
					        <div class="otherReact">
						
                                <a href="./likers.php?type=1&pub=<?php echo $p['idPublication'] ?>" class="reax">
                                    <img src="../reaction/like.png" alt="like" width="35px" class="liked">
                                </a>
                                <a href="./likers.php?type=2&pub=<?php echo $p['idPublication'] ?>" class="reax">
                                    <img src="../reaction/love.png" alt="love" width="35px">
                                </a>
       