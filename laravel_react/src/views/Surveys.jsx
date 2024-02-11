import { PlusCircleIcon } from "@heroicons/react/24/outline";
import PageComponent from "../components/PageComponent"
import SurveyListitem from "../components/SurveyListitem";
import TButton from "../components/core/TButton";
import { useStateContext } from "../contexts/ContextProvider"


function Surveys() {
  const { surveys } = useStateContext();
  console.log(surveys);
  const onDeleteClick = () => {
    console.log("Deleted content");
  }
  return (
    <>
    
    <PageComponent title="Surveys"
       buttons={(
      <TButton color="green" to="surveys/create">
        <PlusCircleIcon className="h-6 w-6 mr-2" />
        Create new
      </TButton>
      
    )}>
    {surveys.map(survey => (
      <SurveyListitem survey={survey} key={survey.id} onClick={onDeleteClick} />
    ))}
   </PageComponent>
   </>
    
  )
}

export default Surveys