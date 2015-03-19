# App_WeFound404
Application Facebook proposant un systéme de vote et l'inscription à une newsletter

## Sommaire
1. [Sujet](#sujet)
    * [Newsletter](#newsl)
    * [Vote du rédacteur du mois](#vote)
2. [Descriptif des fonctionnalités](#descFonc)
    * [Un simple formulaire](#simForm)
    * [Le Systéme de vote](#systVote)
3. [Les étapes utilisateurs](#etapUtil)
    * [Page de présentation](#Ppres)
    * [Page du vote](#Pvote)
    * [Page de réseaux sociaux](#Prs)
4. [Solution technique](#solTech)


## 1. Sujet <a id="sujet"></a> 

WeFound404 est un site d'actualités qui traite de tout type de sujet tenu par des étudiants de l'ECITV,
à destination des étudiants comme des profesionnels. Plus d'info sur le [site de WeFound404](http://wefound404.fr/)

De là, nous avons crée App_WeFound404, qui est une **application Facebook** pour la page Facebook de WeFound404.
Cette application est composé de 2 parties:
* Une partie **Newsletter**
* Une partie **Vote** du le rédacteur du mois

### 1.1 Newsletter <a id="newsl"></a> 
En renseignant son email dans un formulaire, l'utilisateur peut s'inscire à la newsletter de WeFound404.
Cela lui permettra de recevoir chaque semaine un mail avec les meilleurs actualités du moment, des résumés et bien d'autres choses...

### 1.2 Vote du rédacteur du mois <a id="vote"></a> 
Sur la 2eme partie de l'application, aprés s'etre connecté, l'utilisateur pourra effectuer un vote pour un rédacteur de chez WeFound404. Une foi voté, il pourra partager son vote et poster des commentaires concernant le vote.



## 2. Descriptif des fonctionnalités <a id="descFonc"></a> 
### 2.1 Un simple formulaire <a id="simForm"></a>
Concernant la newsletter, il sagit simplement d'un formulaire à renseigner avec son email. L'email va etre récupéré, comparé avec la base de données pour en verifier l'existance ou pas, puis ajouté à la BDD. Les emails serviront ensuite pour l'envoi des mails chaque semaine.

![Alt text](/img/field_newsletter.png "Formulaire d'inscription")

### 2.2 Le Systéme de vote <a id="systVote"></a> 
L'utilisateur doit auparavent se connecté et autoriser l'application à se lier a son compte Facebook.<br/>
Lors de la connexion, on récupére quelques infos nécessaires (email, nom, prenom, age) et on verifie en BDD si l'utilisateur n'a pas déja voté.
A partir de là, il lui serra proposé sous forme de blocs, les différents rédacteurs pour lesquelles ont peu voter.
Si l'utilisateur veut avoir plus d'information sur le rédacteur, il peut cliqué dessus pour etre redirigé vers la page du profil du rédacteur situé le site internet de WeFound404.
Ensuite il ne restera à l'utilisateur qu'à selectionner son choix, et a cliquer sur le bouton "voter".

![Alt text](/img/field_vote.png "Formulaire de vote")

Au moment du vote, il se passe 2 choses en BDD:
* Le vote est comptabilisé, donc la table "VOTE" se met a jour
* Une valeur TRUE/FALSE se rajouter à la table "USER" afin d'empecher un utilisateur de pouvoir voter plusieurs foi. 

Aprés le vote, il est redirigé sur une nouvelle page, qui propose à l'utilisateur plusieurs actions sociales possibles:
* **Un bouton de partage de l'application**, afin de partager l'application et insiter son entourage à venir voter.
* **Un bouton de partage de son vote**, afin de partager son vote et insiter son entourage a voté pour la même personne.
* **Un bouton like**, afin d'indiquer à tout le monde que vous avez apprecié l'application / le vote.
* **Une zone de discussion**, afin de pouvoir laisser un commentaire, une remarque, etc.. en rapport avec le vote.

*Image à venir*


## 3. Les étapes utilisateurs <a id="etapUtil"></a> 
L'application Facebook, se déroule sur les 3 etapes suivantes.

### 3.1 Page de présentation <a id="Ppres"></a> 
La 1ére page sur laquelle arrive l'utilisateur. Cette page est séparé en 2 parties:
* La partie newsletter avec un texte explicatif, un champ pour renseigner son mail et le boutton pour valider.
* La partie vote, avec un texte explicatif et un bouton de connexion pour accéder à la page des votes.

*Pour les 2 cas, si l'utilisateur est déja renseigné ou à déja voté, un message lui indiquera qu'il ne peut pas recommencer*

### 3.2 Page du vote <a id="Pvote"></a>
On accéde à cette page aprés s'etre connecté via la page de présentation.<br>
Elle présente les differents rédacteurs pour lesquels ont peu voter. Une foi que l'utilisateur à voté en appuyant sur le bouton il serra redirigé vers la page des réseaux sociaux.

### 3.3 Page de réseaux sociaux <a id="Prs"></a> 
Cette page est la derniére de l'application. On y est redirigé seulement aprés avoir effectué un vote.
Elle présente different moyen de communiquer autour de l'application et du vote: **partage, like, commentaire**.
C'est maintenant à l'utilisateur d'essayer de faire parler de l'application avec les outils qui lui sont mis à disposition.



## 4. Solution technique <a id="solTech"></a> 





