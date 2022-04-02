import './styles.scss';

/**
 * Add button component.
 * 
 * @returns {JSX.Element}
 */
const AddButton = (): JSX.Element => {
  // Function to handle clicks on the button that route the page to the add product page
  const handleClick = (): void => {
    window.location.href = '/add';
  };

  return (
    <div className="btn-add">
      <button className="btn btn-primary btn-lg btn-block" onClick={handleClick}>
        Add 
      </button>
    </div>
  )
};

export default AddButton;
