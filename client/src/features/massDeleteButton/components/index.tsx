import * as config from '@/config/api';
import './styles.scss';

/**
 * Mass delete button component.
 * 
 * @returns {JSX.Element}
 */
const MassDeleteButton = (): JSX.Element => {
  // handleClick function to send a fetch request to the config.API_URL endpoint to delete all products
  const handleClick = (): void => {
    fetch(`${config.API_URL}/products`, {
      method: 'DELETE',
    })
      .then(() => {
        window.location.reload();
      })
      .catch((error) => {
        console.log(error);
      });

  };

  return (
    <div className="btn-mass-delete">
      <button className="btn btn-primary btn-lg btn-block" onClick={handleClick}>
        Mass Delete
      </button>
    </div>
  )
};

export default MassDeleteButton;
