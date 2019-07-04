export const stepData = [
    {
        step: 1,
        state: "current",
        icon: "",
        stepInfo: {
            title: "Opsætning af brugerkonto!",
            text: "Færdiggør venligst din profil og udfyld dit BadmintonDanmark ID, så du kan blive tilknyttet træninger mv.",
            svg: "/base/media/wizard/undraw_checklist_7q37.svg"
        },
        contentComponent: "setPassword"
    },
    {
        step: 2,
        state: "pending",
        icon: "",
        stepInfo: {
            title: "Vi bekymrer os om dine data!",
            text: "I forhold til GDPR skal vi bede dig bekræfte at vi må behandle dine data",
            svg: "/base/media/wizard/undraw_resume_folder_2_arse.svg"
        },
        contentComponent: "step1Content"
    },
    {
        step: 3,
        state: "pending",
        icon: "",
        stepInfo: {
            title: "Opsætning af brugerkonto!",
            text: "To start off, please enter your username, email address and password.",
            svg: "/base/media/wizard/undraw_live_collaboration_2r4y.svg"
        },
        contentComponent: "step2Content"
    },
    {
        step: 4,
        state: "pending",
        icon: "",
        stepInfo: {
            title: "Opsætning af brugerkonto!",
            text: "To start off, please enter your username, email address and password.",
            svg: "/base/media/wizard/undraw_hiring_cyhs.svg"
        },
        contentComponent: "step4Content"
    }
];