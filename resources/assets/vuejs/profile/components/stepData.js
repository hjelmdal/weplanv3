export const stepData = [
    {
        step: 0,
        state: "current",
        icon: "",
        stepInfo: {
            title: "Opsætning af brugerkonto!",
            text: "Færdiggør venligst din profil og udfyld dit BadmintonDanmark ID, så du kan blive tilknyttet træninger mv.",
            svg: "/base/media/wizard/undraw_checklist_7q37.svg"
        },
        contentComponent: "step0Welcome"
    },
    {
        step: 1,
        state: "pending",
        icon: "",
        stepInfo: {
            title: "Opsætning af brugerkonto!",
            text: "Færdiggør venligst din profil og udfyld dit BadmintonDanmark ID, så du kan blive tilknyttet træninger mv.",
            svg: "/base/media/wizard/undraw_checklist_7q37.svg"
        },
        contentComponent: "step1Password"
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
        contentComponent: "step2GDPR"
    },
    {
        step: 3,
        state: "pending",
        icon: "",
        stepInfo: {
            title: "Indstilling af profilbillede",
            text: "Vi har behov for at du angiver et tydeligt billede af dit ansigt som profilbillede, for at din træner hurtigt og nemt kan sætte dig på træninger mv.",
            svg: "/base/media/wizard/undraw_live_collaboration_2r4y.svg"
        },
        contentComponent: "step3Avatar"
    },
    {
        step: 4,
        state: "pending",
        icon: "",
        stepInfo: {
            title: "Opsætning af brugerkonto!",
            text: "For at kunne identificere dig som spiller, skal du angive dit spillerid fra Badminton Danmark nedenfor",
            svg: "/base/media/wizard/undraw_hiring_cyhs.svg"
        },
        contentComponent: "step4Player"
    }
];