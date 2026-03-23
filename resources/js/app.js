import "./bootstrap";

document.addEventListener("DOMContentLoaded", async () => {
    let modal = null;

    try {
        const res = await fetch("/api/portfolio");
        const data = await res.json();

        // PROFILE
        if (data.profile) {
            const nameEl = document.getElementById("name");
            const designationEl = document.getElementById("designation");
            const aboutEl = document.getElementById("about");
            const avatarEl = document.getElementById("avatar");

            if (nameEl) nameEl.textContent = data.profile.name ?? "";
            if (designationEl)
                designationEl.textContent = data.profile.designation ?? "";
            if (aboutEl) aboutEl.textContent = data.profile.about ?? "";

            if (avatarEl && data.profile.avatar) {
                avatarEl.src = data.profile.avatar;
            }
        }

        //  PROJECTS
        const projectsEl = document.getElementById("projects-list");

        if (projectsEl && Array.isArray(data.projects)) {
            projectsEl.innerHTML = "";

            data.projects.forEach((project, index) => {
                const card = document.createElement("div");
                card.className =
                    "rounded-xl border bg-white p-6 shadow-sm hover:shadow transition";

                card.innerHTML = `
                    <h3
                        class="cursor-pointer text-xl font-semibold text-slate-900 hover:text-indigo-600 transition"
                        data-project-index="${index}"
                    >
                        ${project.title}
                    </h3>

                    ${
                        project.github_url
                            ? `<a href="${project.github_url}" target="_blank"
                                class="mt-3 inline-block text-sm font-medium text-slate-600 hover:text-indigo-600">
                                View on GitHub →
                               </a>`
                            : ""
                    }
                `;

                projectsEl.appendChild(card);
            });
        }

        // PROJECT MODAL
        modal = document.getElementById("project-modal");
        const modalTitle = document.getElementById("modal-title");
        const modalDescription = document.getElementById("modal-description");
        const modalClose = document.getElementById("modal-close");

        if (modal && modalTitle && modalDescription) {
            document.addEventListener("click", (e) => {
                const target = e.target;

                if (target.matches("[data-project-index]")) {
                    const project = data.projects[target.dataset.projectIndex];

                    if (modalTitle) modalTitle.textContent = project.title;

                    if (Array.isArray(project.description)) {
                        modalDescription.innerHTML = `
                            <ul class="list-disc list-inside space-y-2">
                                ${project.description
                                    .map((point) => `<li>${point}</li>`)
                                    .join("")}
                            </ul>
                        `;
                    } else {
                        modalDescription.textContent =
                            project.description ?? "";
                    }

                    modal.classList.remove("hidden");
                    modal.classList.add("flex");
                }
            });

            if (modalClose) {
                modalClose.addEventListener("click", () => {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                });
            }

            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                }
            });
        }

        // SKILLS
        const skillsEl = document.getElementById("skills-list");

        if (skillsEl && Array.isArray(data.skills)) {
            skillsEl.innerHTML = "";

            data.skills.forEach((skill) => {
                skillsEl.innerHTML += `
                    <span class="rounded-lg bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-700">
                        ${skill.name}
                    </span>
                `;
            });
        }

        // RESUME
        const resumeBox = document.getElementById("resume-box");

        if (resumeBox) {
            if (data.resume) {
                const resumeUrl = data.resume.file_name
                    ? `/storage/documents/documents/${data.resume.file_name}`
                    : null;

                const updatedDate = new Date(
                    data.resume.updated_at,
                ).toLocaleDateString();

                resumeBox.innerHTML = `
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <p class="text-lg font-semibold text-slate-900">
                                ${data.resume.title ?? "Resume"}
                            </p>
                            <p class="mt-1 text-sm text-slate-500">
                                Last updated: ${updatedDate}
                            </p>
                        </div>

                        ${
                            resumeUrl
                                ? `<a href="${resumeUrl}" target="_blank"
                                     class="inline-flex items-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition">
                                     View PDF
                                   </a>`
                                : `<span class="text-sm text-slate-500">No resume available</span>`
                        }
                    </div>
                `;
            } else {
                resumeBox.innerHTML = `<p class="text-sm text-slate-500">No resume uploaded.</p>`;
            }
        }

        // SERVICES
        const servicesEl = document.getElementById("services-list");

        if (servicesEl && Array.isArray(data.services)) {
            servicesEl.innerHTML = "";

            data.services.forEach((service) => {
                servicesEl.innerHTML += `
                    <div class="rounded-2xl border border-slate-200 p-6
                                transition hover:shadow-md hover:-translate-y-1">
                        <h3 class="text-lg font-semibold mb-2">
                            ${service.title}
                        </h3>

                        <p class="text-slate-600 text-sm leading-relaxed">
                            ${service.description}
                        </p>
                    </div>
                `;
            });
        }

        // CONTACT
        if (data.profile) {
            const { email, phone, github_link, linkedin_link } = data.profile;

            if (email) {
                const el = document.getElementById("contact-email");
                const text = document.getElementById("email-text");

                if (el && text) {
                    el.href = `mailto:${email}`;
                    text.textContent = email;
                    el.classList.remove("hidden");
                }
            }

            if (phone) {
                const el = document.getElementById("contact-phone");
                const text = document.getElementById("phone-text");

                if (el && text) {
                    el.href = `tel:${phone}`;
                    text.textContent = phone;
                    el.classList.remove("hidden");
                }
            }

            if (github_link) {
                const el = document.getElementById("contact-github");
                const text = document.getElementById("github-text");

                if (el && text) {
                    el.href = github_link;
                    text.textContent = github_link.replace(/^https?:\/\//, "");
                    el.classList.remove("hidden");
                }
            }

            if (linkedin_link) {
                const el = document.getElementById("contact-linkedin");
                const text = document.getElementById("linkedin-text");

                if (el && text) {
                    el.href = linkedin_link;
                    text.textContent = linkedin_link.replace(
                        /^https?:\/\//,
                        "",
                    );
                    el.classList.remove("hidden");
                }
            }
        }

        // SCROLL ANIMATION
        document.querySelectorAll("section").forEach((section) => {
            section.classList.add("opacity-0", "translate-y-6");

            const observer = new IntersectionObserver(
                ([entry]) => {
                    if (entry.isIntersecting) {
                        section.classList.remove("opacity-0", "translate-y-6");
                        section.classList.add("transition-all", "duration-700");
                    }
                },
                { threshold: 0.15 },
            );

            observer.observe(section);
        });
    } catch (err) {
        console.error("❌ Portfolio load failed", err);
    }

    // ESC KEY
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && modal) {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }
    });
});

//  ADMIN PROJECT
const projectTitles = document.querySelectorAll(".project-title");

if (projectTitles.length > 0) {
    projectTitles.forEach((el) => {
        el.addEventListener("click", () => {
            const form = document.getElementById("update-project-form");

            if (!form) return;

            form.action = `/admin/${el.dataset.id}/updateProject`;

            const idEl = document.getElementById("update-project-id");
            const titleEl = document.getElementById("update-title");
            const descEl = document.getElementById("update-description");
            const githubEl = document.getElementById("update-github");
            const liveEl = document.getElementById("update-live");
            const modalEl = document.getElementById("update-project-modal");

            if (idEl) idEl.value = el.dataset.id;
            if (titleEl) titleEl.value = el.dataset.title;
            if (descEl) descEl.value = el.dataset.description;
            if (githubEl) githubEl.value = el.dataset.github;
            if (liveEl) liveEl.value = el.dataset.live;

            if (modalEl) modalEl.classList.remove("hidden");
        });
    });
}
