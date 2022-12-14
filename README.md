# RavenDesk

A problem that many kinds of writers face is the issue of keeping track of information related to their writing projects. 

Many writers try to keep this information in their heads, but the brain is a fickle mistress, and while it might offer unlimited storage, 
it is not very reliable. The same can be said for physical notebooks, weak to external forces. 

In comes The Raven Desk, a website aimed at writers in need of a sleek, easy-to-use and efficient solution to this problem. 
This web app provides a digital space accessible from any location in which users can create and store details about their stories and works
in an organized fashion.

**Table of Contents**
- [How to Use (Demo)](#how-to-use)
  - [Getting Started](#getting-started)
  - [Creating a Project](#creating-a-project)
  - [Editing a Project (blurb, plot points, characters, etc)](#editing-a-project)
- [Chosen Technology](#chosen-technology)
- [Future Iterations](#future-iterations)

<br>


## How to Use 

As building this project locally would require much work on a visitor's part, I've decided to include a miniature demo in this readme.

### Getting Started
- The Raven Desk begins as any webapp does, with a signup/login page.
  <img src="https://user-images.githubusercontent.com/55061982/207726437-814514ac-d720-4eb7-9dc8-49fb3e0af3b9.png" width="90%" />

### Creating a Project

- A logged in user will have access to the user dashboard, on which they can view all their current projects.
  A **project** on The Raven Desk represents a single book or series an author is working on. Click on the giant plus sign to add a new project.
  <img src="https://user-images.githubusercontent.com/55061982/207727209-9620bcfd-ceb4-45f8-bb7d-1a6585db9d95.png" width="90%" />
  
  It's okay if you change your mind -- a project can always be deleted or renamed later.
   <img src="https://user-images.githubusercontent.com/55061982/207727241-a63d4218-8166-4730-8632-a7d91c29a54d.gif" width="90%" />

### Editing a Project
- You can start by adding a book cover and a description called a "blurb" to your project. The picture can be changed later, and the blurb is 
  automatically saved as you type.
  <img src="https://user-images.githubusercontent.com/55061982/207728773-09c84363-c06d-4060-9b58-a4f5948a9da6.png" width="90%" />
  
- You can also add different **books** to your project! Each book represents just that, a single book in a series. A project can contain one book
  or multiple books.
  <img src="https://user-images.githubusercontent.com/55061982/207729296-4a8ac583-e64d-4cdf-bc36-ba66e15dd142.png" width="90%" />

  Each book has its own plot, so you can add plot threads to each book. The plot threads allow for text styling such as bold and italicized text for
  emphasis. And of course, you can go back and edit a plot point if you wish. Changes are saved automatically.
  <img src="https://user-images.githubusercontent.com/55061982/207729346-0f66da84-2749-4a9e-b51c-41868a69fc42.gif" width="90%" />
  
- A book is often most well-known for the **characters** that appear in it! Characters can be created from scratch, or even imported from other projects.
  <img src="https://user-images.githubusercontent.com/55061982/207730080-06f3a212-8a8c-4c82-8e5f-77c05b7e455d.png" width="90%" />
  
  An image can be added to represent a character, and you can enter lots of useful information pertaining to a character. As always, changes are saved
  automatically.
  <img src="https://user-images.githubusercontent.com/55061982/207730316-7b883593-67d9-4498-8d57-24f0a3913841.gif" width="90%" />

- Similarly to characters, you can also add locations to your **world**, and articles to your **encyclopedia** to represent unique things about a story
  that don't quite fit into any other categories. The Raven Desk aims to be there for all your story needs!

<br>


## Chosen Technology

When building this project, I chose to go as simple as possible. Up to the point I had started, I'd used modern tech stack tools such as Firebase for
database management, Python for backend development, React and Angular for frontend development and design frameworks such as Tailwind and Bootstrap.

However, I saw the value in going back to the very basics and learning to understand intimately how a web app is actually built from scratch. Thus, I
went with a simple database manager, MariaDB, PHP for backend and user management, and pure vanilla HTML, CSS and Javascript for everything else.

It was certainly an experience. There were many times I wish I had access to React's reusable components, or an external service to manage user
authentication <i>for</i> me. But in the end, I don't regret choosing to do so as I feel like I learned a lot from the experience, as well as a new 
appreciation of the modern tools used for web development today.

<br>


## Future Iterations

This project in its current form is "completed," but should I ever continue to work on this project, there are a few aspects of its functionality that I 
would like to improve and/or expand upon.

A future version of The Raven Desk would allow more customization for users, such as allowing them to upload multiple images per character/location/
article and reorganizing plot points. They would also be able to ideally create their own categories if they wish.

I would also want to allow for more collaboration, such as by allowing users to share a single project among them, such as in the case of co-authors.

In addition, I would want to redo the GUI to make it more modern, sleek and accessible. As suggested by an acquaintance of mine, I would also like to add
an overview page where the user see a bird’s eye view of all their work.
